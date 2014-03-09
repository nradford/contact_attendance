<?php
class class_report_model extends CI_Model{
	public function __construct(){
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function check_ins_get($date){
        $sql = "SELECT c.id AS contact_id, c.fname, c.lname, c.notes, check_in.id, check_in.checked_in, check_in.checked_out, check_in.check_in_code, classes.id AS class_id, classes.name AS class_name, visitor, offering";
        // $sql .= "COUNT(if(check_in.visitor=1, 1, NULL)) AS num_visitors ";
        $sql .= " FROM contacts c ";
        $sql .= "LEFT JOIN check_in ON c.id=check_in.contact_id ";
        $sql .= "LEFT JOIN classes ON check_in.class_id=classes.id ";
        $sql .= "WHERE check_date='".$date."' ORDER BY visitor ASC, checked_in DESC";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0)$data = $query->result_array();

		return $data;
	}

    public function class_report_totals($date){
        $sql = "SELECT SUM(offering) AS offering_total, ";
        $sql .= "COUNT(if(visitor=1, id, NULL)) AS num_visitors, ";
        $sql .= "COUNT(if(checked_in > 0, id, NULL)) AS num_check_ins, ";
        $sql .= "COUNT(if(checked_out > 0, id, NULL)) AS num_check_outs ";
        $sql .= "FROM check_in ";
        $sql .= "WHERE check_date='".$date."'";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0)$data = $query->row_array();
		return $data;
    }

    public function class_report_get($date){
        $this->db->select("id, incident, summary");
        $this->db->where("check_date", $date);
        $data = $this->db->get('class_reports', 1, 0);
        if($data->num_rows() > 0)$report = $data->row_array();
        return $report;
    }

    public function class_report_save(){
        $success = 0;
        $data = array(
            "incident" => htmlspecialchars($this->input->post('incident')),
            "summary" => htmlspecialchars($this->input->post('summary')),
            "check_date" => $this->input->post('class_date')
        );
        if($this->input->post('class_report_id') > 0){//if updating
            $this->db->where("id", $this->input->post('class_report_id'));
            $this->db->update("class_reports", $data);
            if($this->db->_error_message() == "")$success = 1;
        }else{//if new
            $this->db->insert("class_reports", $data);
            if($this->db->_error_message() == "")$success = 1;
        }

        /* generate pdf and attach it */
        $report_name = "class-report-".date('Y-m-d');
        $url = $this->config->item('report_full_url')."?class_date=".$this->input->post('class_date');
        
        // Create an html file to pass to wkhtmltopdf to create the report pdf from
        $curl = curl_init();
        $fp = fopen("/tmp/".$report_name.".html", "w");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FILE, $fp);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_USERAGENT, 'report-export-Jsbv36{8zDLXH7wo;WcFVVgNvhK6nAhn');
        curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($httpCode != 404 ){
            $contents = curl_exec($curl);
            fwrite($fp, $contents);
        }

        curl_close($curl);
        fclose($fp);

        // Convert the html report to pdf
        $command = "sudo wkhtmltopdf -O landscape --disable-javascript /tmp/".$report_name.".html ".$this->config->item('reports_path').$report_name.".pdf";
        $result = exec($command);
        unlink("/tmp/".$report_name.".html");//delete the html file
        
        // Send email notification
        $this->load->library('email');
        $this->email->from("no-reply@solidrockfamilychurch.org", 'Kidz Rock Check-In/Out System');
        $this->email->to("nickrradford@gmail.com"); 
        // $this->email->to("sarahradford@gmail.com"); 
        $this->email->subject('Class Report for '.date('n/j/Y', strtotime($this->input->post('class_date'))));
        $this->email->attach($this->config->item('reports_path').$report_name.".pdf");

        $body = "<p>Class Report for ".date('n/j/Y', strtotime($this->input->post('class_date')))."</p>";
        $this->email->message($body);

       if(!$this->email->send()){
           //log the error
           $handle = fopen("/var/mail_log/email.log", "a");
           fwrite($handle, "########################".date("Y-m-d H:i:s")."########################\n".$this->email->print_debugger()."\n\n\n\n");
           fclose($handle);
       }

        return $success;
    }
}
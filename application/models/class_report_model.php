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

    public function incident_report_get($date){
        $this->db->select("id, report");
        $this->db->where("check_date", $date);
        $data = $this->db->get('incident_reports', 1, 0);
        if($data->num_rows() > 0)$report = $data->row_array();
        return $report;
    }

    public function class_report_save(){
        $success = 0;
        $data = array(
            "report" => htmlspecialchars($this->input->post('incident_report')),
            "check_date" => $this->input->post('class_date')
        );
        if($this->input->post('incident_id') > 0){//if updating
            $this->db->where("id", $this->input->post('incident_id'));
            $this->db->update("incident_reports", $data);
            if($this->db->_error_message() == "")$success = 1;
        }else{//if new
            $this->db->insert("incident_reports", $data);
            if($this->db->_error_message() == "")$success = 1;
        }

        return $success;
    }
}
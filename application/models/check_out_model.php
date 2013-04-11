<?php
class check_out_model extends CI_Model{
	function __construct(){
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	function check_ins_get($date){
        //get all check ins that have not been checked out
        $sql = "SELECT c.id AS contact_id, c.fname, c.lname, c.notes, check_in.id, check_in.checked_in, check_in.checked_out, check_in.check_in_code, classes.id AS class_id, classes.name AS class_name FROM contacts c ";
        $sql .= "LEFT JOIN check_in ON c.id=check_in.contact_id ";
        $sql .= "LEFT JOIN classes ON check_in.class_id=classes.id ";
        $sql .= "WHERE check_date='".$date."' AND checked_out='0000-00-00 00:00:00' ORDER BY checked_in DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

	function check_outs_get($date){
        $data = array();
        $sql = "SELECT c.id AS contact_id, c.fname, c.lname, c.notes, check_in.id, check_in.checked_in, check_in.checked_out, check_in.check_in_code, classes.id AS class_id, classes.name AS class_name FROM contacts c ";
        $sql .= "LEFT JOIN check_in ON c.id=check_in.contact_id ";
        $sql .= "LEFT JOIN classes ON check_in.class_id=classes.id ";
        $sql .= "WHERE check_date='".$date."' AND checked_out != '0000-00-00 00:00:00' ORDER BY checked_in DESC";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)$data = $query->result_array();

		return $data;
	}

    function check_out_save(){
        $check_date = $this->input->get('check_date');
        $checked_out_time = date("Y-m-d H:i:s");
        $check_in_id = $this->input->get('check_in_id');

        $sql = 'UPDATE check_in SET checked_out="'.$checked_out_time.'" WHERE id="'.$check_in_id.'";';
        $this->db->query($sql);
        if($check_in_id > 0){
            //look up user data to populate the checked in list with
            $sql = "SELECT c.fname, c.lname, c.notes, check_in.id, check_in.check_in_code, check_in.checked_out FROM check_in LEFT JOIN contacts c ON c.id=check_in.contact_id";
            $sql .= " WHERE check_in.id=".$check_in_id." LIMIT 0,1";
    		$query = $this->db->query($sql);
    		if($query->num_rows() > 0)$data = $query->row();

            $return_data = array(
                'check_out_id' => $data->id,
                'name' => $data->fname." ".$data->lname,
                'check_out_time' => date("g:i a", strtotime($checked_out_time)),
                'notes' => $data->notes,
                // 'class_id' => $data->class_id,
                'check_in_code' => $data->check_in_code
            );

            // return $this->input->get('callback')."(".json_encode($return_data).")";
            return json_encode($return_data);
        }else{
            print "There was an error saving the check out info";
        }
    }

    function check_out_delete(){
        $date = date("Ymd");
        $time = time();
        $check_out_id = $this->input->get('check_out_id');

        $sql = "DELETE FROM check_out WHERE id=".$check_out_id;
        $this->db->query($sql);

        if($this->db->_error_message() == ""){
            print $check_out_id;
        }else{
            print $this->db->_error_message();
        }
    }

        //     function classes_get(){
        //         $sql = "SELECT c.* FROM classes c ORDER BY age_min ASC";
        // $query = $this->db->query($sql);
        // 
        // if($query->num_rows() > 0)$data = $query->result_array();
        // return $data;       
        //     }
        //     
        //     function class_update(){
        //         $sql = "UPDATE check_out SET class_id=".$this->input->post('value')." WHERE id=".$this->input->post('pk');
        // $query = $this->db->query($sql);
        // 
        //         if($this->db->_error_message != ""){
        //             return $this->db->_error_message;
        //         }else{
        //             return "1";
        //         }
        //     }
}
<?php
class check_in_model extends CI_Model{
	function check_ins_get(){
        $today = date("Ymd");
        $sql = "SELECT c.id AS contact_id, c.fname, c.lname, c.notes, check_in.id, check_in.checked_in, classes.id AS class_id FROM contacts c ";
        $sql .= "LEFT JOIN check_in ON c.id=check_in.contact_id ";
        $sql .= "LEFT JOIN classes ON check_in.class_id=classes.id ";
        $sql .= "WHERE check_date=$today ORDER BY checked_in DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

    function contacts_search(){
        /**
         *Look up contact info based on search term
         * 
         *Lookup contact_id, name, and calculate age based on birthdate and then get the class they should be in
        */
        $term = urldecode($this->input->get('term'));
        $limit = 10;
        if($this->input->get('limit') > 0)$limit = $this->input->get('limit');
        $check_date = $this->input->get('check_date');

        /*
            TODO need to prevent multiple checkins for the same contact
        */
        if($term != ""){
            $sql = "SELECT id AS contact_id, fname, lname, notes ";
            // $sql .= "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthdate, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birthdate, '00-%m-%d')) AS age, ";
            // $sql .= "(SELECT `id` FROM `classes` WHERE age BETWEEN age_min AND age_max) AS class_id ";
            $sql .= "FROM contacts ";
            $sql .= "WHERE (fname like '%$term%' OR lname like '%$term%') ";
            $sql .= "AND id NOT IN (SELECT contacts.id FROM contacts LEFT JOIN check_in ON contacts.id=check_in.contact_id WHERE check_date='".$check_date."') ";
            $sql .= "LIMIT 0, $limit;";
            $data = $this->db->query($sql);
        }
        if($data->num_rows() > 0)$results = $data->result_array();
        return $results;
    }

    function check_in_save(){
        $date = date("Y-m-d");
        $checked_in_time = date("Y-m-d H:i:s");
        $contact_id = $this->input->get('contact_id');

        //look up class_id to add to the check in and notes to retun in order to populate the list with the new check-in
        $sql = "SELECT notes, ";
        $sql .= "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthdate, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birthdate, '00-%m-%d')) AS age, ";
        $sql .= "(SELECT `id` FROM `classes` WHERE age BETWEEN age_min AND age_max) AS class_id ";
        $sql .= "FROM contacts WHERE id=".$contact_id;
        $data = $this->db->query($sql);
        if($data->num_rows() > 0)$check_in_data = $data->row_array();

        $class_id = $check_in_data['class_id'];

        $sql2 = "INSERT INTO check_in (contact_id, check_date, checked_in, class_id) VALUES ($contact_id, '$date', '$checked_in_time', '$class_id');";
        $this->db->query($sql2);
        $check_in_id = $this->db->insert_id();
        if($check_in_id > 0){
            $return_data = array(
                'check_in_id' => $check_in_id,
                'name' => urldecode($_GET['name']),
                'check_in_time' => date("g:i a", strtotime($checked_in_time)),
                'notes' => $check_in_data['notes'],
                'class_id' => $class_id
            );

            print $this->input->get('callback')."(".json_encode($return_data).")";
            // print json_encode($return_data);

            // print $check_in_id."|".urlencode($_GET['name'])."|".urlencode(date("g:i a", $time));
        }else{
            print "There was an error saving the check-in info";
        }
    }

    function check_in_delete(){
        $date = date("Ymd");
        $time = time();
        $check_in_id = $this->input->get('check_in_id');

        $sql = "DELETE FROM check_in WHERE id=".$check_in_id;
        $this->db->query($sql);

        if($this->db->_error_message() == ""){
            print $check_in_id;
        }else{
            print $this->db->_error_message();
        }
    }
    
    
    
    
    
    
    
    
    
    
    function classes_get(){
        $sql = "SELECT c.* FROM classes c ORDER BY age_min ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;       
    }
    
    function class_update(){
        $sql = "UPDATE check_in SET class_id=".$this->input->post('value')." WHERE id=".$this->input->post('pk');
		$query = $this->db->query($sql);

        if($this->db->_error_message != ""){
            return $this->db->_error_message;
        }else{
            return "1";
        }
    }
}
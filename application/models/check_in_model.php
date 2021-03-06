<?php
class check_in_model extends CI_Model{
	public function __construct(){
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function check_ins_get($date){
        $sql = "SELECT c.id AS contact_id, c.fname, c.lname, c.notes, check_in.id, check_in.checked_in, check_in.checked_out, check_in.check_in_code, classes.id AS class_id, classes.name AS class_name, visitor, offering FROM contacts c ";
        $sql .= "LEFT JOIN check_in ON c.id=check_in.contact_id ";
        $sql .= "LEFT JOIN classes ON check_in.class_id=classes.id ";
        $sql .= "WHERE check_date='".$date."' ORDER BY checked_in DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

    public function contacts_search(){
        /**
         *Look up contact info based on search term
         * 
         *Lookup contact_id, name
        */
        $results = array();
        $term = urldecode($this->input->get('term'));
        $limit = 10;
        if($this->input->get('limit') > 0)$limit = $this->input->get('limit');
        $check_date = $this->input->get('check_date');

        if($term != ""){
            $sql = "SELECT id AS contact_id, fname, lname ";
            $sql .= "FROM contacts ";
            $sql .= "WHERE (fname like '%$term%' OR lname like '%$term%') ";
            $sql .= "AND id NOT IN (SELECT contacts.id FROM contacts LEFT JOIN check_in ON contacts.id=check_in.contact_id WHERE check_date='".$check_date."') ";
            $sql .= "LIMIT 0, $limit;";
            $data = $this->db->query($sql);
        }
        if($data->num_rows() > 0)$results = $data->result_array();
        return $results;
    }

    public function check_in_save(){
        $check_date = $this->input->get('check_date');
        $checked_in_time = date("Y-m-d H:i:s");
        $contact_id = $this->input->get('contact_id');

        /**
         * Look up class_id, notes, and calculate age based on birthdate and then get the class they should be in
         * Retun in order to populate the list with the new check-in
        */
        $sql = "SELECT notes, ";
        $sql .= "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthdate, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birthdate, '00-%m-%d')) AS age, ";
        $sql .= "(SELECT `id` FROM `classes` WHERE age BETWEEN age_min AND age_max ORDER BY id ASC LIMIT 0,1) AS class_id ";
        $sql .= "FROM contacts WHERE id='".$contact_id."'";
        $data = $this->db->query($sql);
        if($data->num_rows() > 0)$check_in_data = $data->row_array();
        
        $this->load->helper('check_in_code');
        $check_in_code = check_in_code($check_date);
        $class_id = $check_in_data['class_id'];

        $sql2 = "INSERT INTO check_in (contact_id, check_date, checked_in, class_id, check_in_code) VALUES ($contact_id, '$check_date', '$checked_in_time', '$class_id', '$check_in_code');";
        $this->db->query($sql2);
        $check_in_id = $this->db->insert_id();

        if($check_in_id > 0){
            $return_data = array(
                'check_in_id' => $check_in_id,
                'name' => urldecode($this->input->get('name')),
                'check_in_time' => date("g:i a", strtotime($checked_in_time)),
                'notes' => $check_in_data['notes'],
                'class_id' => $class_id,
                'check_in_code' => $check_in_code
            );

            print $this->input->get('callback')."(".json_encode($return_data).")";
            // print json_encode($return_data);

            // print $check_in_id."|".urlencode($_GET['name'])."|".urlencode(date("g:i a", $time));
        }else{
            print "There was an error saving the check-in info";
        }
    }

    public function check_in_delete(){
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

    public function classes_get(){
        $sql = "SELECT c.* FROM classes c ORDER BY age_min ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;       
    }
    
    public function class_update(){
        $sql = "UPDATE check_in SET class_id=".$this->input->post('value')." WHERE id=".$this->input->post('pk');
		$query = $this->db->query($sql);

        if($this->db->_error_message() != ""){
            redirect(base_url()."AnyPageThatDoesntReturnStatusOf200");
        }else{
            return "1";
        }
    }

    /**
     * Teacher check-in methods 
    */
	public function check_ins_teachers_get($date){
        $data = array();
        $sql = "SELECT t.id AS teacher_id, t.fname, t.lname, check_in_teachers.id, check_in_teachers.checked_in, classes.id AS class_id, classes.name AS class_name FROM teachers t ";
        $sql .= "LEFT JOIN check_in_teachers ON t.id=check_in_teachers.teacher_id ";
        $sql .= "LEFT JOIN classes ON check_in_teachers.class_id=classes.id ";
        $sql .= "WHERE check_date='".$date."' ORDER BY checked_in DESC";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

    public function teachers_search(){
        /**
         *Look up teacher info based on search term
         * 
         *Lookup teacher_id and name
        */
        $results = array();
        $term = urldecode($this->input->get('term'));
        $limit = 10;
        if($this->input->get('limit') > 0)$limit = $this->input->get('limit');
        $check_date = $this->input->get('check_date');

        if($term != ""){
            $sql = "SELECT id AS teacher_id, fname, lname ";
            $sql .= "FROM teachers ";
            $sql .= "WHERE (fname like '%$term%' OR lname like '%$term%') ";
            $sql .= "AND id NOT IN (SELECT teachers.id FROM teachers LEFT JOIN check_in_teachers ON teachers.id=check_in_teachers.teacher_id WHERE check_date='".$check_date."') ";
            $sql .= "LIMIT 0, $limit;";
            $data = $this->db->query($sql);
        }
        if($data->num_rows() > 0)$results = $data->result_array();
        return $results;
    }

    public function check_in_teacher_save(){
        $check_date = $this->input->get('check_date');
        $checked_in_time = date("Y-m-d H:i:s");
        $teacher_id = $this->input->get('teacher_id');
        
        //look up class_id
        $sql = "SELECT class_id FROM teachers ";
        $sql .= "WHERE id='".$teacher_id."'";
        $sql .= "LIMIT 0, 1";
        $data = $this->db->query($sql);
        if($data->num_rows == 1)$class_info = $data->row_array();

        $sql2 = "INSERT INTO check_in_teachers (teacher_id, check_date, checked_in, class_id) VALUES ($teacher_id, '$check_date', '$checked_in_time', '$class_info[class_id]');";
        $this->db->query($sql2);
        $check_in_id = $this->db->insert_id();
        if($check_in_id > 0){
            $return_data = array(
                'check_in_id' => $check_in_id,
                'name' => urldecode($this->input->get('name')),
                'check_in_time' => date("g:i a", strtotime($checked_in_time)),
                'class_id' => $class_info['class_id']
            );

            print $this->input->get('callback')."(".json_encode($return_data).")";
        }else{
            print "There was an error saving the check-in info";
        }
    }

    public function check_in_teacher_delete(){
        $date = date("Ymd");
        $time = time();
        $check_in_id = $this->input->get('check_in_id');

        $sql = "DELETE FROM check_in_teachers WHERE id=".$check_in_id;
        $this->db->query($sql);

        if($this->db->_error_message() == ""){
            print $check_in_id;
        }else{
            print $this->db->_error_message();
        }
    }

    public function class_teacher_update(){
        $sql = "UPDATE check_in_teachers SET class_id=".$this->input->post('value')." WHERE id=".$this->input->post('pk');
		$query = $this->db->query($sql);

        if($this->db->_error_message() != ""){
            redirect(base_url()."AnyPageThatDoesntReturnStatusOf200");
        }else{
            return "1";
        }
    }

    /**
     * Offering methods
    */
    public function offering_update(){
        $offering = str_replace(array("$", ","), "", $this->input->post('value'));
        $offering = number_format($offering, "2", ".", "");
        
        if(is_numeric($offering)){
            $sql = "UPDATE check_in SET offering='".$offering."' WHERE id=".$this->input->post('pk');
    		$query = $this->db->query($sql);

            if($this->db->_error_message() != ""){
                redirect(base_url()."AnyPageThatDoesntReturnStatusOf200");
            }else{
                return 1;
            }            
        }else{
            return 1;
        }
    }

    /**
     * Visitor methods
    */
    public function visitor_update(){
        $sql = "UPDATE check_in SET visitor='".$this->input->post('value')."' WHERE id=".$this->input->post('pk');
		$query = $this->db->query($sql);

        if($this->db->_error_message() != ""){
            redirect(base_url()."AnyPageThatDoesntReturnStatusOf200");
        }else{
            return "1";
        }
    }   
}
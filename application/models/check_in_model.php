<?php
class check_in_model extends CI_Model{
	function check_ins_get(){
        $today = date("Ymd");
        $sql = "SELECT c.fname, c.lname, check_in.id, check_in.checked_in FROM contacts c LEFT JOIN check_in ON c.id=check_in.contact_id WHERE check_date=$today ORDER BY checked_in ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

    function contacts_search(){
        $term = urldecode($this->input->get('term'));
        $limit = 10;
        if($this->input->get('limit') > 0)$limit = $this->input->get('limit');

        if($term != ""){
            $sql = $sql = "SELECT id as contact_id, fname, lname FROM contacts WHERE fname like '%$term%' OR lname like '%$term%' LIMIT 0, $limit;";
            $data = $this->db->query($sql);
        }
        if($data->num_rows() > 0)$results = $data->result_array();
        return $results;
    }

    function check_in_save(){
    	$date=date("Ymd");
    	$time=time();
    	$contact_id=$_GET['contact_id'];
	
    	$sql="INSERT INTO check_in (contact_id, check_date, checked_in) VALUES ($contact_id, $date, $time);";
    	$this->db->query($sql);
    	$check_in_id = $this->db->insert_id();
    	if($check_in_id > 0){
    		print $check_in_id."|".urlencode($_GET['name'])."|".urlencode(date("g:i a", $time));
    	}else{
    		print "There was an error saving the check in info";
    	}
    }
}
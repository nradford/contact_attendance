<?php
class contacts_model extends CI_Model{
	function contacts_get(){
        $sql = "SELECT * FROM contacts ORDER BY lname ASC, fname ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}
}
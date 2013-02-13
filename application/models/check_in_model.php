<?php
class check_in_model extends CI_Model{
	function check_ins_get(){
        $today = date("Ymd");
        $sql = "SELECT c.first_name, c.last_name, check_in.id, check_in.checked_in FROM contacts c LEFT JOIN check_in ON c.id=check_in.contact_id WHERE check_date = $today ORDER BY checked_in ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->row_array();
		return $data;
	}
}
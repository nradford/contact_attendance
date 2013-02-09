<?php
class login_model extends CI_Model{
	function validate(){
		$this->db->select('id, email');
		$this->db->from('accounts');
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', sha1($this->input->post('password')));
		$query = $this->db->get();

		if($query->num_rows() > 0)$data = $query->row_array();
		return $data;
	}
}
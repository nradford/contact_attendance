<?php
class classes_model extends CI_Model{
	public function __construct(){
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function classes_get(){
        $sql = "SELECT * FROM classes ORDER BY age_min ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

    public function class_get(){
        $sql = "SELECT * FROM classes WHERE id = ".$this->input->post('class_id');
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->row_array();

		return $data;        
    }

    public function class_save(){
        $class_id = $this->input->post('class_id');
        $class_data = array();
        $class_data['name'] = $this->input->post('class_name');
        $class_data['age_min'] = $this->input->post('age_min');
        $class_data['age_max'] = $this->input->post('age_max');

        if($class_id == ""){//add new class
            $this->db->insert('classes', $class_data);
            $class_id = $this->db->insert_id();
        }else{//edit class
            $this->db->where('id', $class_id);
            $this->db->update('classes', $class_data);
            if($this->db->_error_message() != "")$class_id = $this->db->_error_message();
        }
        return $class_id;
    }

    public function class_delete(){
        $id = $this->input->post('class_id');

        $this->db->query('DELETE FROM classes WHERE id="'.$id.'"');

        if($this->db->_error_message() != ""){
            return 0;
        }else{
            return 1;
        }
    }
}
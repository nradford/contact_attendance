<?php
class teachers_model extends CI_Model{
	public function __construct(){
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function teachers_get(){
        $sql = "SELECT * FROM teachers ORDER BY lname ASC, fname ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

    public function teacher_get(){
        $sql = "SELECT * FROM teachers WHERE id = ".$this->input->post('teacher_id');
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->row_array();

		return $data;        
    }

    public function teacher_save(){
        $teacher_id = $this->input->post('teacher_id');
        $teacher_data = array();
        $teacher_data['status'] = $this->input->post('status');
        $teacher_data['lname'] = $this->input->post('lname');
        $teacher_data['fname'] = $this->input->post('fname');

        $bd = "";
        if($this->input->post('birthdate') != ""){
            //convert birthdate to yyyy-mm-dd for storing in the db
            $bd = $this->input->post('birthdate');
            $bd_parts = explode("/", $bd);
            $bd = $bd_parts[2]."/".$bd_parts[0]."/".$bd_parts[1];
            $bd = date("Y-m-d", strtotime($bd));
        }

        $teacher_data['birthdate'] = $bd;
        $teacher_data['email'] = $this->input->post('email');
        $teacher_data['mobile_phone'] = $this->input->post('mobile_phone');
        $teacher_data['home_phone'] = $this->input->post('home_phone');
        $teacher_data['address'] = $this->input->post('address');
        $teacher_data['address2'] = $this->input->post('address2');
        $teacher_data['city'] = $this->input->post('city');
        $teacher_data['state'] = $this->input->post('state');
        $teacher_data['zip'] = $this->input->post('zip');
        $teacher_data['notes'] = htmlspecialchars($this->input->post('notes'));

        if($teacher_id == ""){//add new teacher
            $this->db->insert('teachers', $teacher_data);
            $teacher_id = $this->db->insert_id();
        }else{//edit teacher
            $this->db->where('id', $teacher_id);
            $this->db->update('teachers', $teacher_data);
            if($this->db->_error_message() != "")$teacher_id = $this->db->_error_message();
        }
        return $teacher_id;
    }

    public function note_save(){
        $id = $this->input->post('pk');
        $note = $this->input->post('value');
        
        $this->db->query('UPDATE teachers SET notes="'.htmlspecialchars($note).'" WHERE id="'.$id.'"');

        if($this->db->_error_message() != ""){
            redirect(base_url()."AnyPageThatDoesntReturnStatusOf200");
        }else{
            return $id;
        }
    }

    public function teacher_delete(){
        $id = $this->input->post('teacher_id');

        $this->db->query('DELETE FROM teachers WHERE id="'.$id.'"');

        if($this->db->_error_message() != ""){
            return 0;
        }else{
            return 1;
        }
    }
}
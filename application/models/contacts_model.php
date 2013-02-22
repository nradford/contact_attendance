<?php
class contacts_model extends CI_Model{
	function contacts_get(){
        $sql = "SELECT * FROM contacts ORDER BY lname ASC, fname ASC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->result_array();
		return $data;
	}

    function contact_get(){
        $sql = "SELECT * FROM contacts WHERE id = ".$this->input->post('contact_id');
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)$data = $query->row_array();

		return $data;        
    }

    function contact_save(){
        $contact_id = $this->input->post('contact_id');
        $contact_data = array();
        $contact_data['status'] = $this->input->post('status');
        $contact_data['lname'] = $this->input->post('lname');
        $contact_data['fname'] = $this->input->post('fname');
        $bd = "";
        if($this->input->post('birthdate') != ""){
            $bd = date("Ymd", strtotime($this->input->post('birthdate')));
        }
        $contact_data['birthdate'] = $bd;
        $contact_data['email'] = $this->input->post('email');
        $contact_data['mobile_phone'] = $this->input->post('mobile');
        $contact_data['home_phone'] = $this->input->post('home_phone');
        $contact_data['address'] = $this->input->post('address');
        $contact_data['address2'] = $this->input->post('address2');
        $contact_data['city'] = $this->input->post('city');
        $contact_data['state'] = $this->input->post('state');
        $contact_data['zip'] = $this->input->post('zip');
        $contact_data['school'] = $this->input->post('school');
        $contact_data['notes'] = htmlspecialchars($this->input->post('notes'));
      
        if($contact_id == ""){//add new contact
            $this->db->insert('contacts', $contact_data);
            $contact_id = $this->db->insert_id();
        }else{//edit contact
            $this->db->where('id', $contact_id);
            $this->db->update('contacts', $contact_data);
            if($this->db->_error_message != "")$contact_id = $this->db->_error_message;
        }
        return $contact_id;
    }
}
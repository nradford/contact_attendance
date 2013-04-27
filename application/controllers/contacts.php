<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class contacts extends CI_Controller{
	public function __construct(){
        parent::__construct();
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function index(){
        $this->load->model('contacts_model');
        $data['contacts'] = $this->contacts_model->contacts_get();

		$data['main_content'] = 'contacts_list_view';
		$this->load->view('template_view', $data);
	}

    public function contact_add(){
        $data = array();
        $data['contact'] = "";

		$data['main_content'] = 'contact_add_view';
		$this->load->view('template_view', $data);
    }
    
    public function contact_edit(){
        $this->load->model('contacts_model');
        $data['contact'] = $this->contacts_model->contact_get();

		$data['main_content'] = 'contact_add_view';
		$this->load->view('template_view', $data);
    }

    public function contact_save(){
        $this->load->model('contacts_model');
        $contact_id = $this->contacts_model->contact_save();
        
        if($contact_id > 0){
            if($this->input->post('visitor') == "1"){
                $this->session->set_flashdata('notification', 'Visitor saved.');
                redirect(base_url()."check_in");
            }else{
                $this->session->set_flashdata('notification', 'Record saved.');
                redirect(base_url()."contacts");   
            }
        }else{
            $this->session->set_flashdata('notification', 'Record could not be be deleted.');
            redirect(base_url()."contacts/contact_edit");
        }
    }
    
    public function note_save(){
        $this->load->model('contacts_model');
        $contact_id = $this->contacts_model->note_save();
        
        print $contact_id;
    }

    public function contact_delete(){
        $this->load->model('contacts_model');
        $success = $this->contacts_model->contact_delete();

        if($success == "1"){
            $this->session->set_flashdata('notification', 'Record deleted.');
        }else{
            $this->session->set_flashdata('notification', 'Record could not be be deleted.');            
        }
        redirect(base_url().'contacts');
    }
}
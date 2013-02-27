<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class contacts extends CI_Controller{
	public function index(){
        /*
            TODO check to see if user is logged in
        */

        $this->load->model('contacts_model');
        $data['contacts'] = $this->contacts_model->contacts_get();

		$data['main_content'] = 'contacts_list_view';
		$this->load->view('template_view', $data);
	}

    function contact_add(){
        $data = array();
        $data['contact'] = "";

		$data['main_content'] = 'contact_add_view';
		$this->load->view('template_view', $data);
    }
    
    function contact_edit(){
        $this->load->model('contacts_model');
        $data['contact'] = $this->contacts_model->contact_get();

		$data['main_content'] = 'contact_add_view';
		$this->load->view('template_view', $data);
    }

    function contact_save(){
        $this->load->model('contacts_model');
        $contact_id = $this->contacts_model->contact_save();
        if($contact_id > 0){
            redirect(base_url()."contacts");
        }else{
            redirect(base_url()."contacts/contact_edit");
        }
    }
    
    function note_save(){
        $this->load->model('contacts_model');
        $contact_id = $this->contacts_model->note_save();
        
        print $contact_id;
    }
}
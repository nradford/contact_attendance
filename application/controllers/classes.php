<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class classes extends CI_Controller{
	public function __construct(){
        parent::__construct();
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function index(){
        $this->load->model('classes_model');
        $data['classes'] = $this->classes_model->classes_get();

		$data['main_content'] = 'classes_list_view';
		$this->load->view('template_view', $data);
	}

    public function class_add(){
        $data = array();
        $data['class'] = "";

		$data['main_content'] = 'class_add_view';
		$this->load->view('template_view', $data);
    }
    
    public function class_edit(){
        $this->load->model('classes_model');
        $data['class'] = $this->classes_model->class_get();

		$data['main_content'] = 'class_add_view';
		$this->load->view('template_view', $data);
    }

    public function class_save(){
        $this->load->model('classes_model');
        $class_id = $this->classes_model->class_save();
        
        if($class_id > 0){
            $this->session->set_flashdata('notification', 'Class saved.');
            redirect(base_url()."classes");
        }else{
            $this->session->set_flashdata('notification', 'Class could not be be deleted.');
            redirect(base_url()."classes/class_edit");
        }
    }
    
    public function class_delete(){
        $this->load->model('classes_model');
        $success = $this->classes_model->class_delete();

        if($success == "1"){
            $this->session->set_flashdata('notification', 'Class deleted.');
        }else{
            $this->session->set_flashdata('notification', 'Class could not be be deleted.');            
        }
        redirect(base_url().'classes');
    }
}
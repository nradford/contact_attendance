<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class teachers extends CI_Controller{
	public function __construct(){
        parent::__construct();
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function index(){
        $this->load->model('teachers_model');
        $data['teachers'] = $this->teachers_model->teachers_get();

		$data['main_content'] = 'teachers_list_view';
		$this->load->view('template_view', $data);
	}

    public function teacher_add(){
        $data = array();
        $data['teacher'] = "";

		$data['main_content'] = 'teacher_add_view';
		$this->load->view('template_view', $data);
    }
    
    public function teacher_edit(){
        $this->load->model('teachers_model');
        $data['teacher'] = $this->teachers_model->teacher_get();

		$data['main_content'] = 'teacher_add_view';
		$this->load->view('template_view', $data);
    }

    public function teacher_save(){
        $this->load->model('teachers_model');
        $teacher_id = $this->teachers_model->teacher_save();
        
        if($teacher_id > 0){
            $this->session->set_flashdata('notification', 'Record saved.');
            redirect(base_url()."teachers");   
        }else{
            $this->session->set_flashdata('notification', 'Record could not be be deleted.');
            redirect(base_url()."teachers/teacher_edit");
        }
    }

    public function teacher_delete(){
        $this->load->model('teachers_model');
        $success = $this->teachers_model->teacher_delete();

        if($success == "1"){
            $this->session->set_flashdata('notification', 'Record deleted.');
        }else{
            $this->session->set_flashdata('notification', 'Record could not be be deleted.');            
        }
        redirect(base_url().'teachers');
    }
}
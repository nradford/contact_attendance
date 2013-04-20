<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class check_in extends CI_Controller{
	public function __construct(){
        parent::__construct();
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function index(){
        $data['check_date'] = date('Y-m-d');
        if($this->input->post('check_date') != "")$data['check_date'] = $this->input->post('check_date');

        $this->load->model('check_in_model');
        $data['check_ins'] = $this->check_in_model->check_ins_get($data['check_date']);
        
        $data['classes'] = $this->check_in_model->classes_get();

		$data['main_content'] = 'check_in_view';
		$this->load->view('template_view', $data);
	}

    function date_change(){
        /**
         *XHR for changing the date n the check_in pages
        */
        print $this->input->post('value');
    }

    function contacts_search(){
        $this->load->model('check_in_model');
        $results = $this->check_in_model->contacts_search();
        print '{"'.$this->input->get("callback").'": '.json_encode($results).'}';
    }

    function check_in_save(){
        $this->load->model('check_in_model');
        $results = $this->check_in_model->check_in_save();
        
        print $results;
    }
    
    function check_in_delete(){
        $this->load->model('check_in_model');
        $id = $this->check_in_model->check_in_delete();
        
        print $id;
    }

    function classes_get(){
        $this->load->model('check_in_model');
        $classes = $this->check_in_model->classes_get();
    }

    function class_update(){
        $this->load->model('check_in_model');
        $update = $this->check_in_model->class_update();

        print $update;
    }

    /**
     * Teacher check-in methods
    */
	public function check_in_teachers(){
        $data['check_date'] = date('Y-m-d');
        if($this->input->post('check_date') != "")$data['check_date'] = $this->input->post('check_date');

        $this->load->model('check_in_model');
        $data['check_ins'] = $this->check_in_model->check_ins_teachers_get($data['check_date']);
        
        $data['classes'] = $this->check_in_model->classes_get();

		$data['main_content'] = 'check_in_teachers_view';
		$this->load->view('template_view', $data);
	}

    public function teachers_search(){
        $this->load->model('check_in_model');
        $results = $this->check_in_model->teachers_search();
        print '{"'.$this->input->get("callback").'": '.json_encode($results).'}';
    }

    public function check_in_teacher_save(){
        $this->load->model('check_in_model');
        $results = $this->check_in_model->check_in_teacher_save();
        
        print $results;
    }
    
    public function check_in_teacher_delete(){
        $this->load->model('check_in_model');
        $id = $this->check_in_model->check_in_teacher_delete();
        
        print $id;
    }

    public function class_teacher_update(){
        $this->load->model('check_in_model');
        $update = $this->check_in_model->class_teacher_update();

        print $update;
    }

/**
 * Offering methods
*/
    public function offering_update(){
        $this->load->model('check_in_model');
        $results = $this->check_in_model->offering_update();
        
        print $results;
    }

/**
 * Visitor methods
*/    
    public function visitor_update(){
        $this->load->model('check_in_model');
        $results = $this->check_in_model->visitor_update();
        
        print $results;
    }

}
/* End of file check_in.php */
/* Location: ./application/controllers/check_in.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class check_in extends CI_Controller{
	public function __construct(){
        parent::__construct();
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function index(){
        $this->load->model('check_in_model');
        $data['check_ins'] = $this->check_in_model->check_ins_get();
        
        $data['classes'] = $this->check_in_model->classes_get();

		$data['main_content'] = 'check_in_view';
		$this->load->view('template_view', $data);
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
        
        // print "************<pre>";
        // print_r($classes);
        // print "</pre>************";
    }

    function class_update(){
        $this->load->model('check_in_model');
        $update = $this->check_in_model->class_update();

        print $update;
    }
}
/* End of file check_in.php */
/* Location: ./application/controllers/check_in.php */
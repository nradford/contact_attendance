<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reports extends CI_Controller{
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

        $data['main_content'] = 'report_check_in_view';
        $this->load->view('template_view', $data);
	}

    function date_change(){
        /**
         *XHR for changing the date in the check_in report page
        */
        print $this->input->post('value');
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class class_report extends CI_Controller{
	public function __construct(){
        parent::__construct();
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function index(){
        $data['class_date'] = date('Y-m-d');
        if($this->input->post('class_date') != "")$data['class_date'] = $this->input->post('class_date');

        $this->load->model('class_report_model');
        $data['check_ins'] = $this->class_report_model->check_ins_get($data['class_date']);
        $data['totals'] = $this->class_report_model->class_report_totals($data['class_date']);
        /*
            TODO get teacher check-ins
        */
        $data['incident_report'] = $this->class_report_model->incident_report_get($data['class_date']);

        $this->load->model('check_in_model');
        $data['classes'] = $this->check_in_model->classes_get();

		$data['main_content'] = 'class_report_view';
		$this->load->view('template_view', $data);
	}


}
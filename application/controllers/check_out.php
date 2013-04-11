<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class check_out extends CI_Controller{
	public function __construct(){
        parent::__construct();
        //user must be logged in to access any methods of this class
        validate_user($this->session->userdata);
	}

	public function index(){
        $data['check_date'] = date('Y-m-d');
        if($this->input->post('check_date') != "")$data['check_date'] = $this->input->post('check_date');

        $this->load->model('check_out_model');
        $data['check_ins'] = $this->check_out_model->check_ins_get($data['check_date']);
        $data['check_outs'] = $this->check_out_model->check_outs_get($data['check_date']);

        $this->load->model('check_in_model');
        $data['classes'] = $this->check_in_model->classes_get();

		$data['main_content'] = 'check_out_view';
		$this->load->view('template_view', $data);
	}

    function check_out_save(){
        $this->load->model('check_out_model');
        $results = $this->check_out_model->check_out_save();
        print $results;

        // print $this->input->get('check_out_id');
    }
}
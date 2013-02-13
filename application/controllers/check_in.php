<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class check_in extends CI_Controller{
	public function index(){
        /*
            TODO check to see if user is logged in
        */

        $this->load->model('check_in_model');
        $data['check_ins'] = $this->check_in_model->check_ins_get();

		$data['main_content'] = 'check_in_view';
		$this->load->view('template_view', $data);
	}
}

/* End of file check_in.php */
/* Location: ./application/controllers/check_in.php */
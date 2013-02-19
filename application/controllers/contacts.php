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
}
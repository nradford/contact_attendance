<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		if($this->session->userdata('account_id') > 0){//if user is already logged in
			redirect('/check_in');
		}

		$data['main_content'] = 'login_form_view';
		$this->load->view('template_view', $data);
	}

	function login_submit(){
		$this->load->model('login_model');
		$account_info = $this->login_model->validate();

		$account_id = $account_info['id'];

		if($account_id > 0){//if the user's credentials validated...
			$data = array(
				'email' => $this->input->post('email'),
				'account_id' => $account_id
			);

			$this->session->set_userdata($data);
            redirect(base_url().'check_in');
		}else{// incorrect email or password
			$this->session->set_flashdata('email', $this->input->post('email'));
			$this->session->set_flashdata('error', 'Incorrect email or password');
            $this->index();
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$this->index();
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
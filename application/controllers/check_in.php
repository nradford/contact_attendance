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

    function contacts_search(){
        $this->load->model('check_in_model');
        $results = $this->check_in_model->contacts_search();
        print '{"'.$this->input->get("callback").'": '.json_encode($results).'}';
        // print '{"options": ["PHP", "MySQL", "SQL", "PostgreSQL", "HTML", "CSS", "HTML5", "CSS3", "JSON"]}';
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
}

/* End of file check_in.php */
/* Location: ./application/controllers/check_in.php */
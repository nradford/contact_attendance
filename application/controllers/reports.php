<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
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

    public function date_change(){
        /**
         *XHR for changing the date in the check_in report page
        */
        print $this->input->post('value');
    }

    public function class_report_pdf(){
        $class_date = date('Y-m-d');
        if($this->input->get('class_date') != "")$class_date = $this->input->get('class_date');
        if($this->input->post('class_date') != "")$class_date = $this->input->post('class_date');

        $this->load->model('class_report_model');
        $this->load->model('check_in_model');

        $check_ins = $this->class_report_model->check_ins_get($class_date);
        $totals = $this->class_report_model->class_report_totals($class_date);
        $incident_report = $this->class_report_model->incident_report_get($class_date);
        $teacher_check_ins = $this->check_in_model->check_ins_teachers_get($class_date);
        $classes = $this->check_in_model->classes_get();

        // $data['main_content'] = 'class_report_view';
        // $html = $this->load->view('reports/class_report_view', $data);

        require 'application/views/reports/class_report_view.php';
        
        // $html = '<style>'.file_get_contents('./css/bootstrap.min.css').'</style>';

        // exit($html);
        // $html = '<h1>Class Report</h1>';



    
    
        $this->load->library('pdf');

        // create new PDF document
        $pdf = new TCPDF("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Solid Rock');
        $pdf->SetTitle('Class Report');
        $pdf->SetSubject('Class Report');
        $pdf->SetKeywords('Solid Rock, Kidz Rock');

        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // add a page
        $pdf->AddPage();

        // create some HTML content
        // $html = '<h1>Class Report</h1>';

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        //Close and output PDF document
        $pdf->Output('class_report.pdf', 'I');
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class FormTableCon extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FormTableMod');
        $this->load->library('session');
    }

    public function index(){
        $data['form_names'] = $this->FormTableMod->get_form_names();

        $data1['content'] = $this->load->view('formTableIndex', $data, true);
        $this->load->view('home_page', $data1);
    }

    
    public function get_form_fields(){
        $form_id = $this->input->post('form_id');

        $fields = $this->FormTableMod->get_form_fields($form_id);

        if ($fields != NULL) {
            echo json_encode(['success' => true, 'options' => $fields]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No options found for this form.']);
        }
    }

    public function save_form_table(){
        $form_fields = $this->input->post('form_fields');
        $form_id = $this->input->post('form_id');
        $form_name = $this->FormTableMod->get_form_names($form_id);

        $data['table_heading'] = $form_name[0]->heading;

        $form_fields = implode(",", $form_fields);
        $table_col = $this->FormTableMod->get_table_columns($form_fields);
        $data['table_col'] = $table_col;
        // var_dump($table_col);die;
        
        $this->session->set_userdata('form_data', $data);

        echo json_encode([
            'success' => true,
            'redirect' => base_url('FormTableCon/show_form_table')
        ]);
        
    }

    public function show_form_table() {
        
        $data = $this->session->userdata('form_data');
        
        if ($data) {
            $this->load->view('formTable', $data);
            $this->session->unset_userdata('form_data');
        } else {
            redirect('FormTableCon/index'); 
        }
    }

    public function save_report() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        $report_name = $this->input->post('report_name');
        $report_content = $this->input->post('report_content');
    
        if (empty($report_name) || empty($report_content)) {
            echo json_encode(['success' => false, 'message' => 'Invalid input data']);
            return;
        }
    
        $data = [
            'report_name' => $report_name,
            'report_content' => $report_content,
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        $this->load->model('FormTableMod');
        
        try {
            $result = $this->FormTableMod->save_report($data);
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save report']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Exception: ' . $e->getMessage()]);
        }
    }

    // Fetch all saved reports
public function get_saved_reports() {
    $this->load->model('FormTableMod');
    $reports = $this->FormTableMod->get_all_reports();

    if ($reports) {
        echo json_encode(['success' => true, 'reports' => $reports]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No reports found']);
    }
}

// Fetch a specific report by its ID
public function get_report_by_id() {
    $report_id = $this->input->post('report_id');

    if (empty($report_id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid report ID']);
        return;
    }

    $this->load->model('FormTableMod');
    $report = $this->FormTableMod->get_report_by_id($report_id);

    if ($report) {
        echo json_encode(['success' => true, 'report' => $report]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Report not found']);
    }
}

    

}

?>
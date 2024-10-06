<?php
defined('BASEPATH') or exit('No direct script access allowed');


class FormReportCon extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FormReportMod');
        $this->load->library('session');
    }

    public function index(){
        $data['form_names'] = $this->FormTableMod->get_form_names();
        $this->load->view('formTableIndex', $data);
    }

    public function get_form_data(){
        $form_names = $this->FormTableMod->get_form_names();
        if ($form_names != NULL) {
            echo json_encode(['data' => $form_names]);
        } else {
            echo json_encode(['data' => []]);
        }
    }

    public function get_report_data(){
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

}

?>
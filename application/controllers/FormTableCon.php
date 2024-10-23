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
        
        $form_tbl = $form_name[0]->form_name;

        $col_arr = array();
        foreach($table_col as $col) {
            array_push($col_arr, $col['field_name']);  
        }
        $col_arr = implode(", ", $col_arr);
        $tbl_data = $this->FormTableMod->get_table_data($form_tbl, $col_arr);
        $data['table_data'] = $tbl_data;
        
        $this->session->set_userdata('form_data', $data);

        echo json_encode([
            'success' => true,
            'redirect' => base_url('FormTableCon/show_form_table')
        ]);
        
    }

    public function show_form_table() {
        
        $data = $this->session->userdata('form_data');
        // var_dump($data);die;
        if ($data) {
            $this->load->view('formTable', $data);
            $this->session->unset_userdata('form_data');
        } else {
            redirect('FormTableCon/index'); 
        }
    }

}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormTableMod extends CI_Model {

    public function __construct(){
		parent::__construct();
		$this->load->database();
	}

    public function get_form_names($id = NULL){

        $where = "";
        if($id != NULL){
            $where = "WHERE id = $id";
        }
        $sql = "SELECT * FROM tbl_form_name $where ORDER BY heading";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_form_fields($id){
        $sql = "SELECT * FROM tbl_form_structure WHERE form_name_id = $id";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }
    }

    public function get_table_columns($id){
        $sql = "SELECT * FROM tbl_form_structure WHERE id IN ($id)";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }
    }

    public function save_report($data) {
        if ($this->db->insert('reports', $data)) {
            return true;
        } else {
            log_message('error', 'Database error: ' . $this->db->_error_message());
            return false;
        }
    }

    // Fetch all saved reports
public function get_all_reports() {
    $query = $this->db->get('reports');
    return $query->result_array();
}

// Fetch a specific report by its ID
public function get_report_by_id($report_id) {
    $query = $this->db->get_where('reports', ['id' => $report_id]);
    return $query->row_array();
}


    public function get_table_data($form_tbl, $col_arr) {
        $sql = "SELECT $col_arr FROM $form_tbl";
        $query = $this->db->query($sql);
        // var_dump($query);die;

        if($query->num_rows() > 0){
            return $query->result_array();
        }
    }
}
?>
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
}
?>
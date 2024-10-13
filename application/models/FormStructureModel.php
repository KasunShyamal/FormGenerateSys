<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormStructureModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_form_structures()
	{
		$this->db->select('tbl_form_structure.*, tbl_form_name.form_name, tbl_segmant.seg_name, tbl_db_data_type.data_type, tbl_data_type.type, tbl_field_type.field_type');
		$this->db->from('tbl_form_structure');
		$this->db->join('tbl_form_name', 'tbl_form_name.id = tbl_form_structure.form_name_id');
		$this->db->join('tbl_segmant', 'tbl_segmant.id = tbl_form_structure.seg_id');
		$this->db->join('tbl_db_data_type', 'tbl_db_data_type.id = tbl_form_structure.colomn_type_id');
		$this->db->join('tbl_data_type', 'tbl_data_type.id = tbl_form_structure.data_type_id');
		$this->db->join('tbl_field_type', 'tbl_field_type.id = tbl_form_structure.field_type_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_form_names()
	{
		$this->db->select('*');
		$this->db->from('tbl_form_name');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_segments()
	{
		$this->db->select('*');
		$this->db->from('tbl_segmant');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_column_types()
	{
		$this->db->select('*');
		$this->db->from('tbl_db_data_type');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_types()
	{
		$this->db->select('*');
		$this->db->from('tbl_data_type');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_field_types()
	{
		$this->db->select('*');
		$this->db->from('tbl_field_type');
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_form_structure($data)
	{
		$this->db->insert('tbl_form_structure', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_form_structure($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('tbl_form_structure', $data);
	}

}

?>

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormStructureModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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

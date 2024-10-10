<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SegmentModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_segments()
	{
		$this->db->select('tbl_segmant.*');
		$this->db->from('tbl_segmant');
		$query = $this->db->get();
		return $query->result();
	}

	public function insert_segment($data)
	{
		$this->db->insert('tbl_segmant', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_segment($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('tbl_segmant', $data);
	}

}

?>

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormNameModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert_form_name($data)
	{
		$this->db->insert('tbl_form_name', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}

?>

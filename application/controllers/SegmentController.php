<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SegmentController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SegmentModel');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function add_segment()
	{
		$data = array(
			'seg_name' => $this->input->post('seg_name')
		);
		$res = $this->SegmentModel->insert_segment($data);
		return $res;
	}

	public function edit_segment($id)
	{
		$data = array(
			'seg_name' => $this->input->post('seg_name')
		);
		$res = $this->SegmentModel->update_segment($id, $data);
		return $res;
	}

}

?>
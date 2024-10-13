<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormNameController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('FormNameModel');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	function index()
	{
		$res = $this->FormNameModel->getAllData();
		$data['records'] = $res;
		$data1['content'] = $this->load->view('formname', $data, true);
		$this->load->view('home_page', $data1);
	}

	public function add_form_name()
	{
		$data = array(
			'form_name' => $this->input->post('form_name'),
			'heading' => $this->input->post('heading'),
			'type' => $this->input->post('type')
		);
		$res = $this->FormNameModel->insert_form_name($data);
		return $res;
	}


	public function edit_form_name($id)
	{
		$data = array(
			'form_name' => $this->input->post('form_name'),
			'heading' => $this->input->post('heading'),
			'type' => $this->input->post('type')
		);
		$res = $this->FormNameModel->update_form_name($id, $data);
		return $res;
	}
}

?>

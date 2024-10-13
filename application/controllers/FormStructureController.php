<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormStructureController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('FormStructureModel');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$form_names = $this->getFormNames();
		$segments = $this->getSegments();
		$column_types = $this->getColumnTypes();
		$data_types = $this->getDataTypes();
		$field_types = $this->getFieldTypes();
		$data = [
			'form_names' => $form_names,
			'segments' => $segments,
			'column_types' => $column_types,
			'data_types' => $data_types,
			'field_types' => $field_types,
		];
		$data1['content'] = $this->load->view('formStructure', $data, true);
		$this->load->view('home_page', $data1);
	}

	public function getFormNames()
	{
		$form_names = $this->FormStructureModel->get_form_names();
		return $form_names;
	}

	public function getSegments()
	{
		$segments = $this->FormStructureModel->get_segments();
		return $segments;
	}

	public function getColumnTypes()
	{
		$column_types = $this->FormStructureModel->get_column_types();
		return $column_types;
	}

	public function getDataTypes()
	{
		$data_types = $this->FormStructureModel->get_data_types();
		return $data_types;
	}

	public function getFieldTypes()
	{
		$field_types = $this->FormStructureModel->get_field_types();
		return $field_types;
	}

	public function add_form_structure()
	{
		$data = array(
			'form_name_id' => $this->input->post('form_name'),
			'seg_id' => $this->input->post('segment'),
			'field_name' => $this->input->post('field_name'),
			'colomn_type_id' => $this->input->post('column_type'),
			'length' => $this->input->post('length'),
			'data_type_id' => $this->input->post('data_type'),
			'field_type_id' => $this->input->post('field_type')
		);
		$res = $this->FormStructureModel->insert_form_structure($data);
		return $res;
	}

}

?>

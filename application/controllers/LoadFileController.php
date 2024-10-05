<?php
defined('BASEPATH') or exit('No direct script access allowed');



class LoadFileController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FormGenerationModel');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $rawData = file_get_contents('php://input');
        // Decode the JSON data
        $formdata = json_decode($rawData);
        
        // Pass the data to the view
        $this->load->view('formTemplate', $formdata);
    }

}
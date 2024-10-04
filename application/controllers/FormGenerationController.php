
<?php
defined('BASEPATH') or exit('No direct script access allowed');



class FormGenerationController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FormGenerationModel');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $form_structure = $this->getAllStructureData();
        $data['form_structure'] = $form_structure; 
        
        // Pass the data to the view
        $this->load->view('formGenarationView', $data);
    }

    // Get all structure data
    public function getAllStructureData() {
        $form_structure = $this->FormGenerationModel->form_structure();
        
        if (!$form_structure) {
            return [];
        }

        return $form_structure;
    }

    

}

?>
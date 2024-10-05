
<?php
defined('BASEPATH') or exit('No direct script access allowed');



class FormGenerationController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('StudentModel');
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

    function fetch_structure($id){

        var_dup($id);
        die();
        $form_structure = $this->StudentNodel->fetch_strucrures();

    }

    

}

?>

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

    function fetch_structure(){

        $form_id = $this->post('id');
        $form_structure = $this->StudentNodel->fetch_strucrures();

    }

    

}

?>
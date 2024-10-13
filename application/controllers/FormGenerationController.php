
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

    public function fetch_structure($id){

        
        $form_structured_fields = $this->FormGenerationModel->fetch_structured_fields($id);
        // print_r($form_structured_fields);
        // die();
        
       if($form_structured_fields){
        $data['structured_fields'] = $form_structured_fields;
        
        // Load the view and pass the data
        $this->load->view('template/formTemplate', $data);
       }else{
        echo json_encode(['error' => 'No form structure found.']);
       }
       
    }

    // Get all structure data
    public function getAllStructureData() {
        $form_structure = $this->FormGenerationModel->form_structure();
        
        if (!$form_structure) {
            return [];
        }

        return $form_structure;
    }

    public function add(){


        print_r($_POST);
        die();

        $array=$_POST;

        unset($array['id'], $array['formName']);
        
        $form_id = $this->input->post("id");
        $form_name = $this->input->post("formName");
        
        $formFields = $this->FormGenerationModel->getformFields($form_id);
        // print_r($formFields);
        // die();
        
        $existing = $this->FormGenerationModel->checkTable($form_name);


        if($existing){
            $insertData = $this->FormGenerationModel->insertValue($form_name,$array);
  
            
        }else{
            // Start building the CREATE TABLE query
            $query = "CREATE TABLE `$form_name` (\n";
            $query .= "  `id` INT AUTO_INCREMENT PRIMARY KEY,\n";

            // Loop through each field to add column definitions
            foreach ($formFields as $field) {
                $field_name = $field->field_name;
                $type = strtoupper($field->type);  // Ensure SQL type is in uppercase (e.g., VARCHAR)
                $length = $field->length;

                // Add the column definition to the query
                $query .= "  `$field_name` $type($length),\n";
            }

            // Remove the trailing comma from the last column definition
            $query = rtrim($query, ",\n") . "\n";

            // Close the query with the primary key (assuming the first column is the primary key)
            $query .= ");";

            $execute = $this->FormGenerationModel->executeQuery($query);
            if($execute){
                $insertData = $this->FormGenerationModel->insertValue($form_name,$array);
              
            }


            
        }
        
    }

    

}

?>
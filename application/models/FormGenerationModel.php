
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormGenerationModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function form_structure() {
        // Fetch data from the database
        // $query = $this->db->get('tbl_form_structure'); // Replace 'tbl_form_structure' with your actual table name
        // $result = $query->result(); // Fetch results as an array of objects
        // return $result;

        $this->db->select('tbl_form_structure.*,tbl_form_name.form_name,tbl_form_name.heading'); // Select all columns
        $this->db->from('tbl_form_structure'); // Specify the table
        $this->db->join('tbl_form_name', 'tbl_form_structure.form_name_id = tbl_form_name.id', 'left'); // Join with tbl_form_name using a left join
        $this->db->group_by('tbl_form_structure.form_name_id'); // Group by the 'id' column
    
        $query = $this->db->get(); // Execute the query
        return $query->result(); // Return the result
    }

    function fetch_strucrures(){

    }
}

?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormGenerationModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function form_structure() {
      
        $this->db->select('tbl_form_structure.*,tbl_form_name.form_name,tbl_form_name.heading'); 
        $this->db->from('tbl_form_structure');
        $this->db->join('tbl_form_name', 'tbl_form_structure.form_name_id = tbl_form_name.id', 'left');
        $this->db->group_by('tbl_form_structure.form_name_id');
    
        $query = $this->db->get(); // Execute the query
        return $query->result(); // Return the result
    }

    function fetch_strucrures(){

    }
}

?>
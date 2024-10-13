
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

    function fetch_structured_fields($id) {
        $this->db->select('fs.form_name_id, s.seg_name, fs.field_name, dt.html_code as data_html, ft.html_code as field_html, f.heading as title, f.id as id, f.form_name as formName');
        $this->db->from('tbl_form_structure fs');
        $this->db->join('tbl_segmant s', 'fs.seg_id = s.id');
        $this->db->join('tbl_data_type dt', 'fs.data_type_id = dt.id');
        $this->db->join('tbl_field_type ft', 'fs.field_type_id = ft.id');
        $this->db->join('tbl_form_name f', 'fs.form_name_id = f.id');
        $this->db->where('fs.form_name_id', $id);
        $query = $this->db->get();
    
        // Convert the result into an array
        $result = $query->result_array();
    
        $segments = [
            'heading' => '', 
            'fields' => []
        ];
    
        // Group fields by segment
        foreach ($result as $row) {
            $segment = $row['seg_name'];
    
            // Set the form heading (title) only once
            if (empty($segments['heading'])) {
                $segments['formName'] = $row['formName'];
                $segments['id'] = $row['id'];
                $segments['heading'] = $row['title'];
            }
    
            // Initialize the array for the segment if not set
            if (!isset($segments['fields'][$segment])) {
                $segments['fields'][$segment] = [];
            }
    
            // Replace placeholders {name} and {id} with field_name
            $field_name = htmlspecialchars($row['field_name'], ENT_QUOTES, 'UTF-8');
            $field_html = str_replace(['{name}', '{id}'], [$field_name, $field_name], $row['field_html']);
    
            // Debugging: Log or print field HTML to ensure correct replacements
            // Uncomment the line below if you want to see the output
            // echo "Generated Field HTML: " . $field_html . "<br>";
    
            // Add the HTML for this field to the corresponding segment
            $segments['fields'][$segment][] = $field_html;
        }
    
        return $segments;
    }
    

    function getformFields($form_id){
        $this->db->select('tbl_form_structure.field_name, tbl_form_structure.length as length, tbl_db_data_type.data_type as type');
        $this->db->from('tbl_form_structure');
        $this->db->join('tbl_db_data_type', 'tbl_db_data_type.id = tbl_form_structure.colomn_type_id');
        $this->db->where('tbl_form_structure.form_name_id', $form_id);
        $query = $this->db->get();
        return $query->result();
    }

    function checkTable($form_name){

        $query = $this->db->query("SHOW TABLES LIKE '$form_name'");
        return $query->num_rows() > 0;
    }

    function executeQuery($query){

        if ($this->db->query($query)) {
            return true;
        } else {
            // Handle query errors
            $error = $this->db->error();
            return false;
        }
    }

    //insert data
    function insertValue($formname,$data){
        print_r($data);
        die();
       return $this->db->insert($formname,$data);       
    }
    
    
}

?>
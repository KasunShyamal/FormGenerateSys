
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
        $this->db->select('fs.form_name_id, s.seg_name, fs.field_name, dt.html_code as data_html, ft.html_code as field_html, f.heading as title');
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
                $segments['heading'] = $row['title'];
            }
    
            // Initialize the array for the segment if not set
            if (!isset($segments['fields'][$segment])) {
                $segments['fields'][$segment] = [];
            }
            
            // Replace placeholders {name} and {id} in HTML codes
            $field_html = str_replace(['{name}', '{id}'], [$row['field_name'], $row['field_name']], $row['field_html']);
            
            // Add the HTML for this field to the corresponding segment
            $segments['fields'][$segment][] = $field_html;
        }
    
        return $segments;
    }
    
    
}

?>
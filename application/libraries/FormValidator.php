<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormValidator {

    // Constructor
    public function __construct() {
        // You can load any required resources here if needed
    }

    // Validation function for common form fields
    public function validate($data) {
        $CI =& get_instance(); // Get CodeIgniter instance
        $CI->load->library('form_validation'); // Load the form validation library

        // Set validation rules for common fields
        $CI->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
        $CI->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');
        $CI->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $CI->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]');
       // $CI->form_validation->set_rules('dob', 'Date of Birth', 'required|callback_validate_date');

        // Run the validation
        if ($CI->form_validation->run() == FALSE) {
            // If validation fails, return validation errors
            return [
                'status' => false,
                'errors' => validation_errors()
            ];
        }

        // If validation is successful, return validated data
        return [
            'status' => true,
            'data' => $data
        ];
    }

    // Optional: Custom callback function to validate date format
    public function validate_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}

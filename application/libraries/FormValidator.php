<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormValidator {

    // This function will validate all form data
    public function validate($data) {
        $errors = [];
        $validated_data = [];

        // Example validation for common fields
        // You can modify this to include other form fields that are in the 'add' function

        // Validate First Name (assuming a 'first_name' field exists)
        if (empty($data['first_name']) || !preg_match("/^[a-zA-Z\s]+$/", $data['first_name'])) {
            $errors['first_name'] = "First name is required and should only contain letters and spaces.";
        } else {
            $validated_data['first_name'] = $data['first_name'];
        }

        // Validate Last Name (assuming a 'last_name' field exists)
        if (empty($data['last_name']) || !preg_match("/^[a-zA-Z\s]+$/", $data['last_name'])) {
            $errors['last_name'] = "Last name is required and should only contain letters and spaces.";
        } else {
            $validated_data['last_name'] = $data['last_name'];
        }

        // Validate Email (assuming an 'email' field exists)
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "A valid email address is required.";
        } else {
            $validated_data['email'] = $data['email'];
        }

        // Validate Phone Number (assuming a 'phone' field exists)
        if (empty($data['phone']) || !preg_match("/^[0-9]{10}$/", $data['phone'])) {
            $errors['phone'] = "Phone number is required and should be 10 digits long.";
        } else {
            $validated_data['phone'] = $data['phone'];
        }

        // Example: Validate NIC (assuming an 'nic' field exists)
        if (empty($data['nic']) || !preg_match("/^[0-9]{9}[vVxX]$/", $data['nic'])) {
            $errors['nic'] = "NIC is required and must follow the format (9 digits followed by V/v or X/x).";
        } else {
            $validated_data['nic'] = $data['nic'];
        }

        // Additional validations can go here based on the form structure

        // Return validation result
        if (!empty($errors)) {
            return [
                'status' => false,
                'errors' => $errors
            ];
        } else {
            return [
                'status' => true,
                'data' => $validated_data
            ];
        }
    }
}

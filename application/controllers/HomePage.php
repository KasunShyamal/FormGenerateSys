<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomePage extends CI_Controller {  // Make sure capitalization matches the filename

    public function index()
    {
        $this->load->view('home_page'); // Load the homepage view
    }

}

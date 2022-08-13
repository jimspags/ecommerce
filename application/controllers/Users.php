<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("User");
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	// Login
	public function login() {
		$this->load->view('/users/login');
	}

	// Login process
	public function authenticate() {
		// Authenticate
		$is_admin = 1;
		if($is_admin == 1) {
			redirect("dashboard");
		} else if ($is_admin == 0) {
			redirect("catalog");
		}
	}

	// Logoff user
	public function logoff() {
		// Destroy session
		redirect("/login");
	}

	
	// Register page
	public function register() {
		$this->load->view("/users/register");
	}

	// Register process
	public function register_process() {

		if($this->User->validate_register()) { // Check if inputs are valid
			if($this->User->insert_user($this->input->post(NULL, TRUE)) == TRUE) { // Insert into database
				$this->session->set_flashdata("success", "Account " . $this->input->post("email", TRUE) . " is created");
				redirect(base_url() . "register");
			}
		} else {
			$this->session->set_flashdata("errors", validation_errors());

			// Retain input value fields after invalid form inputs
			$this->session->set_flashdata("input_fields",$this->input->post(NULL, TRUE));
			
			redirect(base_url() . "register");
		}
	}




}

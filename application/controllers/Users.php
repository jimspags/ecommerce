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
	public function login_process() {
		if($this->User->validate_login($this->input->post(NULL, TRUE))) { // Validate the user input

			$authenticate_result = $this->User->authenticate_login($this->input->post(NULL, TRUE));
			if($authenticate_result == "user_not_found") { // User not found
				$this->session->set_flashdata("errors", "User does not exists");
				redirect(base_url() . "login");
			} else if($authenticate_result == "invalid_credentials") { // User found but invalid credentials
				$this->session->set_flashdata("errors", "Invalid credentials");
				redirect(base_url() . "login");
			}else if($authenticate_result == "authenticated") { // User authenticated
				if($this->session->userdata("is_admin") == "1") {
					redirect(base_url() . "dashboard");
				} else {
					redirect(base_url());
				}
			}
			
		} else {
			$this->session->set_flashdata("errors", validation_errors());
			$this->session->set_flashdata("input_fields", array("email" => $this->input->post("email", TRUE)));
			redirect(base_url() . "login");
		}
	}


	// Logoff user
	public function logoff() {
		$this->session->sess_destroy();
		redirect(base_url());
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

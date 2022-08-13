<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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


	public function index() {
		$this->load->view("/customers/catalog");
	}

	// Login
	public function login() {
		$this->load->view('/users/login');
	}

	// Login process
	public function authenticate() {
		$is_admin = 1;
		if($is_admin == 1) {
			redirect("admin/dashboard");
		} else if ($is_admin == 0) {
			redirect("/catalog");
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

	// Admin
	public function admin_dashboard() { // Admin index page
		$this->load->view("/admin/dashboard_orders");
	}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Customer");
	}

	public function index() {
		$this->load->view("/customers/catalog");
	}
	
	public function edit_profile() {
		$this->load->view("/customers/edit_profile");
	}

	public function edit_password() {
		$password_response = array();

		// Check password input fields
		$result_validate = $this->Customer->validate_passwords();
		if($result_validate == "invalid_password") { 
			$password_response = array("status" => 400, "errors" => validation_errors());
		} else if ($result_validate == "valid_password"){

			// Update password if input and database password are equal
			$result_match = $this->Customer->update_password($this->input->post("new_password", TRUE), $this->input->post("old_password", TRUE));
			if($result_match == "password_changed") {
				$password_response = array("status" => 200);
			} else if($result_match == "not_matched_password") {
				$password_response = array("status" => 400, "errors" => "Old password incorrect");
			}
	
		}

		echo json_encode($password_response);
	}

	public function shopping_cart() {
		$this->load->view("/customers/shopping_cart");
	}

	public function product_details($product_id) {
		$this->load->view("/customers/product_details");
	}

	public function order_history() {
		$this->load->view("/customers/order_history");
	}

	public function order_history_details($order_id) {
		$this->load->view("/customers/order_history_details");
	}
}

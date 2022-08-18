<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Customer");
		$this->load->model("Product");
	}

	public function index() {
		$all_products = $this->Product->all_products();
		$this->load->view("/customers/catalog", array("products" => $all_products));
	}
	
	// Edit profile page and pass data
	public function edit_profile() {
		$shipping = $this->Customer->get_information_by_table("shipping_information");
		$billing = $this->Customer->get_information_by_table("billing_information");
		
		$this->load->view("/customers/edit_profile", array("shipping" => $shipping, "billing" => $billing));
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

	// Validate and insert shipping information
	public function shipping_process() {
		$shipping_response = array();
		if($this->Customer->validate_shipping() == FALSE) {
			$shipping_response = array("status" => 400, "errors" => validation_errors());
		} else {
			if($this->Customer->check_existence($this->session->userdata("user_id"), $this->input->post("table", TRUE)) == TRUE) {
				// Update query
				$this->Customer->update_shipping($this->input->post(NULL, TRUE));
				$shipping_response = array("status" => 200);
			} else {
				// Insert query
				$this->Customer->insert_shipping($this->input->post(NULL, TRUE));
				$shipping_response = array("status" => 200);
			}
			
		}
		echo json_encode($shipping_response);
	}


	public function billing_process() {
		$billing_response = array();
		if($this->Customer->validate_billing() == FALSE) {
			$billing_response = array("status" => 400, "errors" => validation_errors());
		} else {
			if($this->Customer->check_existence($this->session->userdata("user_id"), $this->input->post("table", TRUE)) == TRUE) {
				// Update query
				$this->Customer->update_billing($this->input->post(NULL, TRUE));
				$billing_response = array("status" => 200);
			} else {
				// Insert query
				$this->Customer->insert_billing($this->input->post(NULL, TRUE));
				$billing_response = array("status" => 200);
			}
			
		}
		echo json_encode($billing_response);
	}


	// Shipping cart page
	public function shopping_cart() {
		$shipping = $this->Customer->get_information_by_table("shipping_information");
		$billing = $this->Customer->get_information_by_table("billing_information");
		$this->load->view("/customers/shopping_cart", array("shipping" => $shipping, "billing" => $billing));
	}

	// Fetch shopping cart table
	public function fetch_shopping_cart() {
		$carts = $this->Customer->get_user_carts();
		$this->load->view("/partials/customers/shopping_cart_table", array("carts" => $carts));
	}


	public function add_to_cart() {
		if($this->Customer->add_to_cart($this->input->post(NULL, TRUE)) == TRUE) {
			echo json_encode(array("status" => 200));
		}
	}

	public function delete_from_cart() {
		$this->Customer->delete_cart($this->input->post("cart_id", TRUE));
		echo json_encode(array("status" => 200));
	}

	public function update_cart_quantity() {
		$this->Customer->update_cart_quantity($this->input->post(NULL, TRUE));
		$this->fetch_shopping_cart();
	}

	public function product_details($product_id) {
		$product = $this->Product->get_product_by_id($product_id);
		$this->load->view("/customers/product_details", array("product" => $product));
	}

	public function order_history() {
		$this->load->view("/customers/order_history");
	}

	public function order_history_details($order_id) {
		$this->load->view("/customers/order_history_details");
	}
}

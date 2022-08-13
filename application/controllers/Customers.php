<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function edit_profile() {
		$this->load->view("/customers/edit_profile");
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
}

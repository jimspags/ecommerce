<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Product");
	}

	public function fetch_products() {
		$all_products = $this->Product->all_products();
		$all_categories = $this->Product->all_categories();
		$this->load->view("/partials/admins/dashboard_products_table", array("products" => $all_products, "categories" => $all_categories));
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

	public function add_product() {
		$response = array();
		if($this->Product->validate_product() == FALSE) {
			$response = array("status" => 400, "errors" => validation_errors());
			echo json_encode($response);
		} else {
			$this->Product->insert_product($this->input->post(NULL, TRUE));
			$response = array("status" => 200);
			echo json_encode($response);
		}
	}

	public function delete_product($id) {
		if($this->Product->delete_product($id) == TRUE) {
			$this->fetch_products();
		}
	}

	public function get_product($id) {
		echo json_encode($this->Product->get_product_by_id($id));
	}


}

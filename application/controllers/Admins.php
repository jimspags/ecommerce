<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Product");
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
	public function index() {
		$this->load->view("admins/dashboard_orders");
	}

	public function dashboard_products() {
		$all_categories = $this->Product->all_categories();
		$this->load->view("admins/dashboard_products", array("categories" => $all_categories));
	}


	public function order_details($order_id) {
		$this->load->view("admins/order_details");
	}

}

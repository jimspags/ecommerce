<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	public function __construct()
	{
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

	public function add_product() {
		$response = array();
		if($this->Product->validate_product() == FALSE) {
			$response = array("status" => 400, "errors" => validation_errors());
		} else {
			$category_id = $this->Product->insert_product($this->input->post(NULL, TRUE));
			$response = array("status" => 200);
		}

		echo json_encode($response);
	}
}

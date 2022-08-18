<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

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

	public function checkout() {
		require './vendor/autoload.php';
		header('Content-Type', 'application/json');

		$stripe = new Stripe\StripeClient("sk_test_51LVuCzG5lxSlsedRNbXW5qWlovG69c3wn4bxPahepy4olOHFEg6MkBKuf1ytBxKEkFNsoqYR7UpqHUdv4yS60gkN00y5NOPgbt");
		$session = $stripe->checkout->sessions->create([
			"success_url" => base_url() . "orders/save_order",
			"cancel_url" => "http://localhost/stripe_api/welcome/cancel",
			"payment_method_types" => ['card', 'alipay'],
			"mode" => 'payment',
			"line_items" => $this->session->userdata("amount_info")
		]);

		echo json_encode($session);

	}

	public function save_order() {

		// Save information to database
		$query_insert = "INSERT INTO orders(user_id, shipped_to, date, billing_address, total, subtotal, shipping_fee, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$values = array($this->session->userdata("user_id"), $this->session->userdata("customer_info")['shipped_to'], date("Y-m-d, H:i:s"), $this->session->userdata("customer_info")['billing_address'], $this->session->userdata("customer_info")['total'], $this->session->userdata("customer_info")['subtotal'], $this->session->userdata("customer_info")['shipping_fee'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
		$result = $this->db->query($query_insert, $values);
		$order_id = $this->db->insert_id();

		$query_update = "UPDATE user_carts SET status = 'Ordered', order_id = ? WHERE user_id = ? AND status = 'Pending'";
		$this->db->query($query_update, array($order_id, $this->session->userdata("user_id")));

		redirect(base_url() . "order_history");
	}


}

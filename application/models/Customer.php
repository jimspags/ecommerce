<?php
    class Customer extends CI_Model {
        // Edit passwords
        public function validate_passwords() {
            $this->form_validation->set_rules("old_password", "Old Password", "required");
            $this->form_validation->set_rules("new_password", "New Password", "required|min_length[8]");
            $this->form_validation->set_rules("confirm_new_password", "Confirm Password", "required|matches[new_password]");

            if($this->form_validation->run() == FALSE) {
                return "invalid_password";
            } else {
                return "valid_password";
            }
        }

        // Update password with validations
        public function update_password($new_password, $old_password) {

            // Fetch old password from database
            $query = "SELECT password, salt FROM users WHERE id = ?";
            $result = $this->db->query($query, $this->session->userdata("user_id"))->row_array();

            // Change password if input password and database password are equal
            if(md5($old_password . $result['salt']) == $result['password']) {
                $query_change = "UPDATE users SET password = ? WHERE id = ?";
                $encrypted_password = md5($new_password . $result['salt']);
                $this->db->query($query_change, array($encrypted_password, $this->session->userdata("user_id")));
                return "password_changed";
            } else {
                return "not_matched_password";
            }
            
        }

        // Validate input billing
        public function validate_billing() {
            $this->form_validation->set_rules("first_name", "First name", "required");
            $this->form_validation->set_rules("last_name", "Last name", "required");
            $this->form_validation->set_rules("address1", "Address", "required");
            $this->form_validation->set_rules("address2", "Address", "required");
            $this->form_validation->set_rules("city", "City", "required");
            $this->form_validation->set_rules("state", "State", "required");
            $this->form_validation->set_rules("zipcode", "Zip Code", "required");
            $this->form_validation->set_rules("card", "Card", "required");
            $this->form_validation->set_rules("security_code", "Security Code", "required");
            $this->form_validation->set_rules("expiration", "Expiration", "required");

            if($this->form_validation->run() == FALSE) {
                return FALSE;
            } else {
                return TRUE;
            }
        }

        // Insert shipping
        public function insert_billing($post) {
            $query = "INSERT INTO billing_information(user_id, first_name, last_name, address, address_2, city, state, zipcode, card_name, security_code, expiration, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $values = array($this->session->userdata("user_id"), $post['first_name'], $post['last_name'], $post['address1'], $post['address2'], $post['city'], $post['state'], $post['zipcode'], $post['card'], $post['security_code'], $post['expiration'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
            
            $this->db->query($query, $values);
        }

        // Update billing
        public function update_billing($post) {
            $query = "UPDATE billing_information SET first_name = ?, last_name = ?, address = ?, address_2 = ?, city = ?, state = ?, zipcode = ?, card_name = ?, security_code = ?, expiration = ?, updated_at = ? WHERE user_id = ?";

            $values = array($post['first_name'], $post['last_name'], $post['address1'], $post['address2'], $post['city'], $post['state'], $post['zipcode'], $post['card'], $post['security_code'], $post['expiration'] . "-01", date("Y-m-d, H:i:s"), $this->session->userdata("user_id"));
            
            $this->db->query($query, $values);
        }


        // Validate input shipping
        public function validate_shipping() {
            $this->form_validation->set_rules("first_name", "First name", "required");
            $this->form_validation->set_rules("last_name", "Last name", "required");
            $this->form_validation->set_rules("address1", "Address", "required");
            $this->form_validation->set_rules("address2", "Address", "required");
            $this->form_validation->set_rules("city", "City", "required");
            $this->form_validation->set_rules("state", "State", "required");
            $this->form_validation->set_rules("zipcode", "Zip Code", "required");

            if($this->form_validation->run() == FALSE) {
                return FALSE;
            } else {
                return TRUE;
            }
        }

        // Insert shipping
        public function insert_shipping($post) {
            $query = "INSERT INTO shipping_information(user_id, first_name, last_name, address, address_2, city, state, zipcode, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?, ? ,?, ?)";

            $values = array($this->session->userdata("user_id"), $post['first_name'], $post['last_name'], $post['address1'], $post['address2'], $post['city'], $post['state'], $post['zipcode'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
            
            $this->db->query($query, $values);
        }

        // Update shipping
        public function update_shipping($post) {
            $query = "UPDATE shipping_information SET first_name = ?, last_name = ?, address = ?, address_2 = ?, city = ?, state = ?, zipcode = ?, updated_at = ? WHERE user_id = ?";

            $values = array($post['first_name'], $post['last_name'], $post['address1'], $post['address2'], $post['city'], $post['state'], $post['zipcode'], date("Y-m-d, H:i:s"), $this->session->userdata("user_id"));
            
            $this->db->query($query, $values);
        }

        // Get information using session with table name
        public function get_information_by_table($table) {
            return $this->db->query("SELECT * FROM {$table} WHERE user_id = ?", array($this->session->userdata("user_id")))->row_array();
        }

        // Check if the information of the user exists on a certain table
        public function check_existence($user_id, $table) {
            $query = "";
            if($table == "shipping_information") {
                $query = "SELECT * FROM shipping_information WHERE user_id = ?";
            }else if ($table == "billing_information") {
                $query = "SELECT * FROM billing_information WHERE user_id = ?";
            }

            if($this->db->query($query, array($user_id))->row_array() != NULL) {
                return TRUE; // Exists
            } else {
                return FALSE; // Does not exists
            }
        }

        public function add_to_cart($post) {
            
            // Check product order existence
            $query_check = "SELECT quantity, total FROM user_carts WHERE user_id = ? AND product_id = ?";
            $values_check = array($this->session->userdata("user_id"), $post['product_id']);
            $result_check = $this->db->query($query_check, $values_check)->row_array();

            
            if($result_check != NULL) {
                // Update quantity and total
                $query_update = "UPDATE user_carts SET quantity = ?, total = ?, updated_at = ? WHERE user_id = ? AND product_id = ?";
                $values_update = array((intval($result_check['quantity']) + intval($post['quantity'])), ($result_check['total'] + $post['total']), date("Y-m-d, H:i:s"), $this->session->userdata("user_id"), $post['product_id']);
                $this->db->query($query_update, $values_update);
            } else {
                // Add to cart
                $query_insert = "INSERT INTO user_carts(user_id, product_id, quantity, total, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?)";
                $values_insert = array($this->session->userdata("user_id"), $post['product_id'], $post['quantity'], $post['total'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
                $this->db->query($query_insert, $values_insert);
            }

            return TRUE;
        }

        // Delete cart item by id
        public function delete_cart($id) {
            $query = "DELETE FROM user_carts WHERE id = ?";
            $this->db->query($query, array($id));
        }

        // Update cart item quantity
        public function update_cart_quantity($post) {
            // Get price item
            $query_get = "SELECT pr.price FROM user_carts uc 
                        LEFT JOIN products pr 
                        ON uc.product_id = pr.id
                        WHERE uc.id = ?";
            $result_get = $this->db->query($query_get, array($post['cart_id']))->row_array();

            $total_price = $result_get['price'] * $post['quantity'];

            $query_update = "UPDATE user_carts SET quantity = ?, total = ? WHERE id = ? AND user_id = ?";
            $this->db->query($query_update, array($post['quantity'], $total_price, $post['cart_id'], $this->session->userdata("user_id")));
        }

        // Get all user cart list
        public function get_user_carts() {
            $query = "SELECT pr.product_name, pr.price, uc.quantity, uc.total, uc.id FROM user_carts uc 
                    LEFT JOIN products pr ON uc.product_id = pr.id 
                    WHERE uc.user_id = ? AND pr.id = uc.product_id AND uc.status = ?";
            return $this->db->query($query, array($this->session->userdata("user_id"), "Pending"))->result_array();
        }

    }


?>
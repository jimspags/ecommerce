<?php
    class User extends CI_Model {

        public function validate_register() {
            $this->form_validation->set_rules("first_name", "First name", "required|min_length[2]");
            $this->form_validation->set_rules("last_name", "First name", "required|min_length[2]");
            $this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
            $this->form_validation->set_rules("password", "Password", "required");
            $this->form_validation->set_rules("confirm_password", "Repeat Password", "required|matches[password]");
            if($this->form_validation->run() == FALSE) {
                return false;
            } else {
                return true;
            }
        }

        public function insert_user($post) {
            // Encrypt password with salt
            $salt = bin2hex(openssl_random_pseudo_bytes(22));
            $encrypted_password = md5($post['password'] . '' . $salt);
            
            $query = "INSERT INTO users(email, first_name, last_name, password, salt, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?)";
            $values = array($post['email'], $post['first_name'], $post['last_name'], $encrypted_password, $salt, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));

            if($this->db->query($query, $values)) {
                return true;
            }
        }


    }
?>
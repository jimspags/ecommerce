<?php
    class User extends CI_Model {

        // Validate register input
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

        // Validate login input
        public function validate_login () {
            $this->form_validation->set_rules("email", "Email address", "required");
            $this->form_validation->set_rules("password", "Password", "required");
            if($this->form_validation->run() == FALSE) {
                return false;
            } else {
                return true;
            }
        }


        // Authenticate on database the user
        public function authenticate_login($post) {
            $query = "SELECT * FROM users WHERE email = ?";
            $result = $this->db->query($query, $post['email'])->row_array();
            if($result != NULL) {
                // Validated password if matched
                if(md5($post['password'] . $result['salt']) == $result['password']) {
                    $user = array(
                        "user_id" => $result['id'],
                        "first_name" => $result['first_name'],
                        "last_name" => $result['last_name'],
                        "is_logged_in" => "1",
                        "is_admin" => $result['is_admin'],
                    );
                    $this->session->set_userdata($user);
                    return "authenticated";
                } else {
                    return "invalid_credentials";
                }

            } else {
                return "user_not_found";
            }

        }



    }
?>
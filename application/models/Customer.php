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

    }


?>
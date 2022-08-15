<?php
    class Shipping extends CI_Model {
        public function validate_shipping() {
            $this->form_validation->set_rules("first_name", "First Name", "required|min_length[2]");
            $this->form_validation->set_rules("last_name", "Last Name", "required|min_length[2]");
            $this->form_validation->set_rules("address", "Address", "required");
            $this->form_validation->set_rules("address_2", "Address 2", "required");
            $this->form_validation->set_rules("address_2", "Address 2", "required");
        }
    }

?>
<?php
    class Product extends CI_Model {

        // Validate product input
        public function validate_product() {
            $this->form_validation->set_rules("name", "Product Name", "required|min_length[2]");
            $this->form_validation->set_rules("description", "Description", "required|min_length[2]");

            // add new category if there is no existing one
            if(empty($this->input->post("category", TRUE))) {
                $this->form_validation->set_rules("new_category", "New Category", "required|is_unique[product_categories.category_name]");
            } else {
                $this->form_validation->set_rules("category", "Category", "required");
            }

            if($this->form_validation->run() == FALSE) {
                return false;
            } else {
                return true;
            }
        }

        public function insert_product($post) {
            $category_id = "";
            // Add the new category in the database and get the ID
            if(!empty($post['new_category'])) {
                $query_category = "INSERT INTO product_categories(category_name, created_at, updated_at) VALUES(?, ?, ?)";
                $this->db->query($query_category, array($post['new_category'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")));
                $category_id = $this->db->insert_id();
            } else {
                $query_find_category = "SELECT id FROM product_categories WHERE category_name = ?";
                $result = $this->db->query($query_find_category, array($post['category']))->row_array();
                $category_id = $result['id'];
            }

            // Insert product on database
            $query_add_product = "INSERT INTO products(user_id, product_category_id, product_name, description, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?)";
            $this->db->query($query_add_product, array($this->session->userdata("user_id"), $category_id, $post['name'], $post['description'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")));

            // Insert image path on database
            $target_dir = base_url() . "assets/img/products/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        }

        // Fetch all categories
        public function all_categories() {
            $query = "SELECT id, category_name FROM product_categories";
            return $this->db->query($query)->result_array();
        }

        // fetch all products
        public function all_products() {
            $query = "SELECT * FROM products";
            return $this->db->query($query)->result_array();
        }



    }

?>
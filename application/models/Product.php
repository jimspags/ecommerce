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

        }


        public function delete_product($id) {
            $query = "DELETE FROM products WHERE id = ?";
		    if($this->db->query($query, array($id))) {
                return TRUE;
            }
        }


        // Fetch all categories
        public function all_categories() {
            $query = "SELECT id, category_name FROM product_categories";
            return $this->db->query($query)->result_array();
        }

        public function all_product_categories() {
            $query = "SELECT pc.category_name, COUNT(pr.id) AS product_count FROM products pr
                    LEFT JOIN product_categories pc
                    ON pr.product_category_id = pc.id
                    GROUP BY pr.product_category_id";
            return $this->db->query($query)->result_array();
        }
        // fetch all products
        public function all_products() {
            $query = "SELECT * FROM products";
            return $this->db->query($query)->result_array();
        }

        public function get_product_by_id($id) {
            return $this->db->query("SELECT p.id, p.product_name, p.description, p.price, c.category_name FROM products p LEFT JOIN product_categories c ON p.product_category_id = c.id WHERE p.id = ? AND c.id = product_category_id", array($id))->row_array();
        }

        public function get_similar_items($product_id, $category) {
            $query = "SELECT pr.id, pr.product_name, pr.price, pc.category_name FROM products pr 
                    LEFT JOIN product_categories pc
                    ON pr.product_category_id = pc.id
                    WHERE pr.id NOT IN(?) AND pc.category_name = ?";
            return $this->db->query($query, array(intval($product_id), $category))->result_array();
        }


    }

?>
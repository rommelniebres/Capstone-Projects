<?php
class Product extends CI_Model {
    public function display_all_products()
    {
        $query = "SELECT products.id as id,
                    products.url AS url,
                    products.name AS name,
                    reviews.rating AS rating,
                    products.price AS price
                    FROM products 
                    LEFT JOIN reviews 
                        ON products.id = reviews.product_id";
        return $this->db->query($query)->result_array();
    }
    public function display_all_categories()
    {
        $query = "SELECT * FROM categories";
        return $this->db->query($query)->result_array();
    }
    public function search_products($data)
    {
        $query = "SELECT products.id as id,
                    products.url AS url,
                    products.name AS name,
                    reviews.rating AS rating,
                    products.price AS price
                    FROM products 
                    LEFT JOIN reviews 
                        ON products.id = reviews.product_id
                    WHERE products.name LIKE ?";
        return $this->db->query($query, $this->security->xss_clean($data.'%'))->result_array();
    }
    public function search_by_category($id)
    {
        $query = "SELECT products.id as id,
                    products.url AS url,
                    products.name AS name,
                    reviews.rating AS rating,
                    products.price AS price
                    FROM categories
                    LEFT JOIN products 
                        ON categories.id = products.category_id
                    LEFT JOIN reviews 
                        ON reviews.product_id = products.id
                    WHERE categories.id = ?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }
    public function search_by_id($id)
    {
        $query = "SELECT products.id as id,
                    products.url AS url,
                    products.name AS name,
                    categories.name AS category,
                    products.category_id AS category_id,
                    products.price AS price,
                    products.description AS description
                    FROM categories
                    LEFT JOIN products 
                        ON categories.id = products.category_id
                    LEFT JOIN reviews 
                        ON reviews.product_id = products.id
                    WHERE products.id = ?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }
    public function url_by_id($id)
    {
        $query = "SELECT url
                    FROM product_images
                    WHERE product_id = ?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array();
    }
}
?>
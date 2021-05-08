<?php
class User extends CI_Model {
    /*  DOCU: This get all the user from the db
        Owner: Rommel
    */
    public function get_all_user()
    {
        $query = "SELECT * FROM users";
        return $this->db->query($query)->result_array();
    }
    /*  DOCU: This get a user from the db based on email
        Owner: Rommel
    */
    public function get_user_by_email($email) 
    {
        $query = "SELECT * FROM users WHERE email=?";
        return $this->db->query($query, $this->security->xss_clean($email))->row_array();
    }
    /*  DOCU: This validate the register form
        Owner: Rommel
    */
    public function validate_register($data) 
    {
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("first_name", "First Name", "trim|required");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required");
        $this->form_validation->set_rules("password", "Password", "required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "required|matches[password]");
        if($this->get_user_by_email($data['email'])) 
        {
            return 'Email already taken.';
        }
        else if(!$this->form_validation->run()) 
        {
            return validation_errors();
        }
    }
    /*  DOCU: This inserts a user into the db and
        check if it is admin or normal user
        Owner: Rommel
    */
    public function add_user($data) 
    {
        if($this->get_all_user())
        {
            $data['user_level'] = '0';
        }
        else
        {
            $data['user_level'] = '9';
        }
        $query = "INSERT INTO users (first_name, last_name, email, password, user_level, created_at) 
                    VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($data['first_name']), 
            $this->security->xss_clean($data['last_name']), 
            $this->security->xss_clean($data['email']), 
            md5($this->security->xss_clean($data['password'])), 
            $this->security->xss_clean($data['user_level']), 
            $this->security->xss_clean($data['created_at'])
        ); 
        return $this->db->query($query, $values);
    }
    /*  DOCU: This validates the login input
        Owner: Rommel
    */
    public function validate_login() {
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("password", "Password", "required");
    
        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }
    /*  DOCU: This validates the login data whether it is match from the
        database
        Owner: Rommel
    */
    public function validate_login_match($user, $password) 
    {
        $encrypted_password = md5($this->security->xss_clean($password));
        if($user && $user['password'] == $encrypted_password) {
            return "success";
        }
        else {
            return "Incorrect email/password.";
        }
    }
    /*  DOCU: This add the user to the database, if this is the first user
        the admin level will be '9' otherwise '0'.
        Owner: Rommel
    */
    public function display_cart_items($id) 
    {
        $query = "SELECT products.id as id,
                        products.name as name,
                        products.price as price
                        ,products.url as url,
                        carts.user_id as user_id,
                        carts.quantity as quantity
                    FROM carts 
                    LEFT JOIN products 
                        ON carts.product_id = products.id 
                        WHERE user_id = ?";
        $values = $this->security->xss_clean($id);
        return $this->db->query($query, $values)->result_array();
    }
    /*  DOCU: Insert item to the cart based on the user cart items
        Owner: Rommel
    */
    public function insert_to_cart($data) 
    {
        $check_exist = $this->check_existing_item_cart($data);
        if($check_exist)
        {
            $query = "UPDATE carts
                        SET quantity = ?
                        WHERE product_id = ? AND user_id = ?;";
            $values = array(
                $this->security->xss_clean(intval($check_exist['quantity'])+intval($data['quantity'])),
                $this->security->xss_clean($data['product_id']), 
                $this->security->xss_clean($data['user_id'])
            ); 
        }
        else
        {
            $query = "INSERT INTO carts (product_id, user_id, quantity, created_at, updated_at) 
                    VALUES (?,?,?,?,?)";
            $values = array(
                $this->security->xss_clean($data['product_id']), 
                $this->security->xss_clean($data['user_id']), 
                $this->security->xss_clean($data['quantity']),
                $this->security->xss_clean($data['created_at']),
                $this->security->xss_clean($data['created_at'])
            ); 
        }
        return $this->db->query($query, $values);
    }
    /*  DOCU: Delete item from the cart based on the user id and product id
        Owner: Rommel
    */
    public function delete_to_cart($data) 
    {
        $query = "DELETE FROM carts WHERE product_id = ? AND user_id = ?;";
        $values = array(
            $this->security->xss_clean($data['product_id']), 
            $this->security->xss_clean($data['user_id'])
        ); 
        $this->db->query($query, $values);
    }
    /*  DOCU: Delete all cart items when checked out
        Owner: Rommel
    */
    public function destroy_cart($user_id) 
    {
        $query = "DELETE FROM carts WHERE user_id = ?;";
        $values = $this->security->xss_clean($user_id);
        $this->db->query($query, $values);
    }
    /*  DOCU: Check existing cart item and add the quantity off a new add to cart
        products
        Owner: Rommel
    */
    public function check_existing_item_cart($data) 
    {
        $query = "SELECT * FROM carts WHERE product_id = ? AND user_id = ?";
        $values = array(
            $this->security->xss_clean($data['product_id']), 
            $this->security->xss_clean($data['user_id'])
        );
        return $this->db->query($query, $values)->row_array();
    }
    /*  DOCU: count the current cart items
        Owner: Rommel
    */
    public function count_cart($user)
    {
        $query = "SELECT * FROM carts WHERE user_id = ?";
        $values = $this->security->xss_clean($user['product_id']);
        return $this->db->query($query, $values)->num_rows();
    }
    /*  DOCU: Validates the address input of the user
        Owner: Rommel
    */
    public function validate_address($data) 
    {
        $this->form_validation->set_rules("first_name", "First Name", "trim|required");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required");
        $this->form_validation->set_rules("phone_number", "Phone Number", "required|numeric");
        $this->form_validation->set_rules("region", "Region", "trim|required");
        $this->form_validation->set_rules("province", "Province", "trim|required");
        $this->form_validation->set_rules("city", "City", "trim|required");
        $this->form_validation->set_rules("barangay", "Barangay", "trim|required");
        $this->form_validation->set_rules("street", "Street", "trim|required");
        $this->form_validation->set_rules("postal_code", "Postal Code", "required|numeric");

        if(!$this->form_validation->run()) 
        {
            return validation_errors();
        }
    }
    /*  DOCU: Validates existing address of the user form the db
        Owner: Rommel
    */
    public function check_exist_address($data)
    {
        $query = "SELECT * FROM addresses WHERE user_id = ? AND is_shipping =? AND is_billing =?" ;
        $values = array(
            $this->security->xss_clean(intval($data['user_id'])),
            $this->security->xss_clean($data['is_shipping']),
            $this->security->xss_clean($data['is_billing'])
        );
        return $this->db->query($query, $values)->row_array();
    }
    /*  DOCU: Add address to the database after it is validated
        Owner: Rommel
    */
    public function add_address($data) 
    {
        $values = array(
            $this->security->xss_clean($data['first_name']), 
            $this->security->xss_clean($data['last_name']), 
            $this->security->xss_clean($data['phone_number']), 
            $this->security->xss_clean($data['region']), 
            $this->security->xss_clean($data['province']), 
            $this->security->xss_clean($data['city']),
            $this->security->xss_clean($data['barangay']),
            $this->security->xss_clean($data['street']),
            $this->security->xss_clean($data['postal_code']),
            $this->security->xss_clean($data['is_shipping']),
            $this->security->xss_clean($data['is_billing']),
            $this->security->xss_clean($data['updated_at']),
            $this->security->xss_clean(intval($data['user_id'])) 
        ); 
        if($this->check_exist_address($data))
        {
            $values[] = $this->security->xss_clean($data['is_shipping']);
            $values[] = $this->security->xss_clean($data['is_billing']);

            $query = "UPDATE addresses
                        SET first_name = ?, 
                            last_name = ?,
                            phone_number= ?,
                            region= ?,
                            province= ?,
                            city= ?,
                            barangay= ?,
                            street= ?,
                            postal_code= ?,
                            is_shipping= ?,
                            is_billing= ?,
                            updated_at= ?
                        WHERE user_id = ?
                        AND is_shipping = ?
                        AND is_billing = ?";
        }
        else
        {
            $query = "INSERT INTO addresses (first_name,
                        last_name, 
                        phone_number, 
                        region, 
                        province, 
                        city, 
                        barangay, 
                        street, 
                        postal_code,
                        is_shipping,
                        is_billing,
                        created_at,
                        user_id) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        }
        return $this->db->query($query, $values);
    }
    /*  DOCU: get the shipping address based on the user id when checked out
        Owner: Rommel
    */
    public function get_shipping_address($user_id)
    {
        $query = "SELECT CONCAT(first_name, ' ',last_name) as name, phone_number as phone, 
                    CONCAT(street, ', ',barangay, ', ',city, ', ',province, ', ',region, ', ',postal_code) as shipping_address,
                    is_shipping,
                    is_billing,
                    updated_at
                    FROM addresses
                    WHERE user_id = ? AND is_shipping = ?
                    ORDER BY updated_at DESC";
        $values = array( 
            $this->security->xss_clean(intval($user_id)),
            $this->security->xss_clean(1)
        );
        return $this->db->query($query, $values)->row_array();
    }
    /*  DOCU: get the billing address based on the user id when checked out
        Owner: Rommel
    */
    public function get_billing_address($user_id)
    {
        $query = "SELECT CONCAT(first_name, ' ',last_name) as name, phone_number as phone, 
                    CONCAT(street, ', ',barangay, ', ',city, ', ',province, ', ',region, ', ',postal_code) as billing_address,
                    updated_at
                    FROM addresses
                    WHERE user_id = ? AND is_shipping = ? AND is_billing = ?
                    ORDER BY updated_at DESC";
        $values = array( 
            $this->security->xss_clean(intval($user_id)),
            $this->security->xss_clean(0),
            $this->security->xss_clean(1)
        );
        return $this->db->query($query, $values)->row_array();
    }
    /*  DOCU: check out process for the user cart
        Owner: Rommel
    */
    public function cart_to_orders($user_id)
    {
        $query = "SELECT id FROM orders WHERE user_id = ? ORDER BY updated_at DESC";
        $values = $this->security->xss_clean(intval($user_id));
        $order_id = $this->db->query($query, $values)->row_array();

        $carts = $this->display_cart_items($user_id);
        $total = 0;
        foreach($carts as $cart)
        {
            $query = "INSERT INTO order_items (order_id, product_id, name, price, quantity, created_at, updated_at)
                    VALUES (?,?,?,?,?,?,?)" ;
            $values = array(
                $this->security->xss_clean(intval($order_id['id'])),
                $this->security->xss_clean(intval($cart['id'])),
                $this->security->xss_clean($cart['name']), 
                $this->security->xss_clean($cart['price']), 
                $this->security->xss_clean($cart['quantity']),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s"))
            );
            $total += floatval($cart['price'])*floatval($cart['quantity']);
            $this->db->query($query, $values);
        }
        $query = "UPDATE orders
                    SET total = ?
                    WHERE id = ?";
        $values = array(
            $this->security->xss_clean(floatval($total)),
            $this->security->xss_clean(intval($order_id))
        );
        $this->db->query($query, $values);
    }
    /*  DOCU: check out process for the user address order
        Owner: Rommel
    */
    public function address_to_orders($user_id)
    {
        $shipping = $this->get_shipping_address($user_id);
        $billing = $this->get_billing_address($user_id);
        if($shipping['is_shipping'] & $shipping['is_billing'] == 1)
        {
            // insert both shipping and billing
            $query = "INSERT INTO orders (user_id, name, phone_number, 
                                shipping_address, billing_address, 
                                status, created_at, updated_at)
                        VALUES (?,?,?,?,?,?,?,?);" ;
            $values = array(
                $this->security->xss_clean(intval($user_id)),
                $this->security->xss_clean($shipping['name']),
                $this->security->xss_clean($shipping['phone']), 
                $this->security->xss_clean($shipping['shipping_address']), 
                $this->security->xss_clean($shipping['shipping_address']), 
                $this->security->xss_clean(1),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s"))
            );
            $this->db->query($query, $values);
        }
        else
        {   
            $query = "INSERT INTO orders (user_id, name, phone_number, 
                                shipping_address, billing_address, status, 
                                created_at, updated_at)
                        VALUES (?,?,?,?,?,?,?,?);" ;
            $values = array(
                $this->security->xss_clean(intval($user_id)),
                $this->security->xss_clean($shipping['name']),
                $this->security->xss_clean($shipping['phone']), 
                $this->security->xss_clean($shipping['shipping_address']),
                $this->security->xss_clean($billing['billing_address']),
                $this->security->xss_clean(1),
                $this->security->xss_clean(date("Y-m-d, H:i:s")),
                $this->security->xss_clean(date("Y-m-d, H:i:s"))
            );
            $this->db->query($query, $values);
        }
    }
}
?>
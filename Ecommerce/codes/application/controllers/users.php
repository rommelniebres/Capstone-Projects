<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    /*  DOCU: This loads the profile info page of the user
        Owner: Rommel
    */
    public function account()
	{
		if($this->session->userdata('user_id'))
		{
			$this->load->view('users/profile.php');
		}
		else
		{
			$this->login();
		}
	}
    /*  DOCU: This loads the view file for login page
        Owner: Rommel
    */
	public function login()
	{
		$this->load->view('users/login.php');
	}
    /*  DOCU: This loads the view file for cart page
        Owner: Rommel
    */
    public function cart()
	{
        if($this->session->userdata('user_id'))
		{
            $items['items'] = $this->user->display_cart_items($this->session->userdata('user_id'));
			$this->load->view('users/cart.php', $items);
		}
		else
		{
			$this->login();
		}
	}
    /*  DOCU: This function insert a product into the cart
        Owner: Rommel
    */
    public function add_to_cart()
	{
        if($this->session->userdata('user_id'))
		{

            $data = array(
                'product_id' => $this->input->post('product_id'),
                'quantity' => $this->input->post('quantity'),
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => date("Y-m-d, H:i:s")
            );
            $this->security->xss_clean($data);
			$this->user->insert_to_cart($data);
            $this->cart_count();
            $this->session->set_flashdata('success', "Added to Cart!");
            redirect('/products/product/'.$data['product_id']);
        }
		else
		{
			$this->login();
		}
	}
    /*  DOCU: This function delete a product from the cart
        Owner: Rommel
    */
    public function delete_cart($id)
	{
        if($this->session->userdata('user_id'))
		{
            $data = array(
                'product_id' => $id,
                'user_id' => $this->session->userdata('user_id')
            );
            $this->security->xss_clean($data);
			$this->user->delete_to_cart($data);
            $this->cart_count();
            $this->session->set_flashdata('success', "Deleted from Cart!");
            redirect('/users/cart');
        }
		else
		{
			$this->login();
		}
	}
    /*  DOCU: This function validates the login input
        Owner: Rommel
    */
	public function login_validate() 
    {
        $result = $this->user->validate_login($this->input->post());
        if($result != 'success') {
            $this->session->set_flashdata('status', $result);
            redirect("users/login");
        } 
        else 
        {
            $email = $this->input->post('email');
            $user = $this->user->get_user_by_email($email);
            $result = $this->user->validate_login_match($user, $this->input->post('password'));
            if($result == "success") 
            {
                $this->session->set_userdata(array('user_id'=>$user['id'], 'first_name'=>$user['first_name']));            
                $this->cart_count();
                if($user['user_level'] !== '9')
                {
                    $this->session->set_userdata('admin', FALSE);
                }
                else
                {
                    $this->session->set_userdata('admin', TRUE);
                }
                redirect("home/index");
            }
            else 
            {
                $this->session->set_flashdata('status', $result);
                redirect("users/login");
            }
        }
    }
    /*  DOCU: This function validates the register input
        Owner: Rommel
    */
	public function register() 
    {
        $result = $this->user->validate_register($this->input->post());
        if($result) 
		{
            $this->session->set_flashdata('status', $result);
		} 
		else 
		{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'created_at' => date("Y-m-d, H:i:s")
			);
			$this->security->xss_clean($data);
			$this->user->add_user($data);
			$this->session->set_flashdata('success', "User Created!");
		}
        redirect('/users/login');
    }
    /*  DOCU: This counts the number of items from cart
        and display it on the upper right of the screen
        Owner: Rommel
    */
    public function cart_count()
    {
        $cart_count = $this->user->count_cart($this->session->userdata('user_id'));
        $this->session->set_userdata('cart_count', $cart_count);
    }
    /*  DOCU: This inserts the shipping info of the user when input
        from the profile page
        Owner: Rommel
    */
    public function shipping_info(){
        $result = $this->user->validate_address($this->input->post());
        if($result) 
		{
            $this->session->set_flashdata('status', $result);
		} 
		else 
		{
			$data = array(
                'user_id' => $this->session->userdata('user_id'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
                'phone_number' => $this->input->post('phone_number'),
                'region' => $this->input->post('region'),
                'province' => $this->input->post('province'),
                'city' => $this->input->post('city'),
                'barangay' => $this->input->post('barangay'),
                'street' => $this->input->post('street'),
                'postal_code' => $this->input->post('postal_code'),
                'is_shipping' => $this->input->post('is_shipping'),
                'is_billing' => $this->input->post('is_billing'),
                'updated_at' => date("Y-m-d, H:i:s")
			);
			$this->security->xss_clean($data);
			$this->user->add_address($data);
			$this->session->set_flashdata('success', "Address Information Updated!");
		}
        redirect('/users/account');
    }
    /*  DOCU: This function insert the confirmed order into the database
        then destroy the cart items and the session cart count
        Owner: Rommel
    */
    public function checkout()
    {
        if($this->user->display_cart_items($this->session->userdata('user_id')))
        {
            $this->user->address_to_orders($this->session->userdata('user_id'));
            $this->user->cart_to_orders($this->session->userdata('user_id'));
            $this->session->set_flashdata('success', "Order Complete!");
        }
        else
        {
            $this->session->set_flashdata('status', "Error: Checkout empty!");
        }
        $this->user->destroy_cart($this->session->userdata('user_id'));
        $this->session->set_userdata('cart_count',0);
        redirect('/users/cart');
    }
    /*  DOCU: This logout the user and clear the sessions
        Owner: Rommel
    */
	public function logout() 
    {
        $this->session->sess_destroy();
        redirect("home");   
    }
}
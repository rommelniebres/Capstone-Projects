<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {
    /*  DOCU: This function load the view file for admin login
        Owner: Rommel
    */
	public function login()
	{
		$this->load->view('admins/admin_login.php');
	}
    /*  DOCU: This validates the login input of the admin 
        Owner: Rommel
    */
	public function login_validate() 
    {
        $result = $this->admin->validate_login($this->input->post());
        if($result != 'success') {
            $this->session->set_flashdata('status', $result);
            redirect("admins/login");
        } 
        else 
        {
            $email = $this->input->post('email');
            $user = $this->admin->get_user_by_email($email);
            $result = $this->admin->validate_login_match($user, $this->input->post('password'));
            if($result == "success") 
            {
                $this->session->set_userdata(array('user_id'=>$user['id'], 'first_name'=>$user['first_name']));
                if($user['user_level'] !== '9')
                {
                    $this->session->set_userdata('admin', FALSE);
                }
                else
                {
                    $this->session->set_userdata('admin', TRUE);
                }
                redirect("/admins/orders");
            }
            else 
            {
                $this->session->set_flashdata('status', $result);
                redirect("admins/login");
            }
        }
    }
    /*  DOCU: This validates the register input of the admin 
        Owner: Rommel
    */
	public function register() 
    {
        $result = $this->admin->validate_register($this->input->post());
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
			$this->admin->add_user($data);
			$this->session->set_flashdata('success', "User Created!");
		}
        redirect('/admins/login');
    }
    /*  DOCU: This loads the view file of the orders dashboards
        Owner: Rommel
    */
	public function orders()
	{
		$this->load->view('admins/admin_orders.php');
	}
    /*  DOCU: This loads the view file of an order details
        Owner: Rommel
    */
	public function order()
	{
		$this->load->view('admins/admin_order_details.php');
	}
    /*  DOCU: This loads the view file of the products dashboards
        Owner: Rommel
    */
	public function products()
	{
		$this->load->view('admins/admin_products.php');
	}
    /*  DOCU: This loads the view file of the login when logged out
        Owner: Rommel
    */
	public function logout()
	{
		$this->load->view('admins/admin_login.php');
	}
}
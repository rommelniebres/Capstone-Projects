<?php
class Admin extends CI_Model {
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
}
?>
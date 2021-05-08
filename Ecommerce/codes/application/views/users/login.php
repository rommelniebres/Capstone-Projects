<?php 
$title = "Login";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>


<body>
    <!------------ Nav -------------->
    <?php include($dir.'/nav.php'); ?>
    <!------------ Switch between Login and Register -------------->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="https://storage.cloud.google.com/ecommerce-capstone/images/logo.png">
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>
                        <form id="LoginForm" action="<?=base_url();?>users/login_validate" method="post">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <input type="text" placeholder="Email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <input type="submit" class="btn" value="Login">
                            <a href="">Forgot Password</a>
                        </form>
                        <form id="RegistrationForm" action="<?=base_url();?>users/register" method="post">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <input type="text" placeholder="First Name" name="first_name">
                            <input type="text" placeholder="Last Name" name="last_name">
                            <input type="email" placeholder="email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <input type="password" placeholder="Confirm Password" name="confirm_password">
                            <input type="submit" class="btn" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="status-validation">
        <?=$this->session->flashdata('status');?>
    </div>
    <div class="status-validation-success">
        <?=$this->session->flashdata('success');?>
    </div>
    <!------------ footer -------------->
    <?php include($dir.'/footer.php'); ?>
    <!------------ JS for toggle menu -------------->
    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px"
        function menuToggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            }
            else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>
    <!------------ JS for toggle form -------------->
    <script>
        var LoginForm = document.getElementById("LoginForm");
        var RegistrationForm = document.getElementById("RegistrationForm");
        var Indicator = document.getElementById("Indicator");
        function register() {
            RegistrationForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
        }
        function login() {
            RegistrationForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }
    </script>

</body>

</html>
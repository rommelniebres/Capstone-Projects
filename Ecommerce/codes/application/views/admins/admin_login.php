<?php 
$title = "Admin Login";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>


<body>
    <!------------ Admin login page ------------>
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <div class="form-container">
                        <div class="form-btn">
                            <h2>Admin</h2>
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>
                        <form id="LoginForm" action="<?=base_url();?>admins/login_validate" method="post">
                            <input type="text" placeholder="Email" name="email">
                            <input type="password" placeholder="Password" name="password">
                            <input type="submit" class="btn" value="Login"></input>
                            <a href="">Forgot Password</a>
                        </form>
                        <form id="RegistrationForm" action="<?=base_url();?>admins/register" method="post">
                            <input type="text" placeholder="Username">
                            <input type="email" placeholder="Email">
                            <input type="password" placeholder="Password">
                            <input type="password" placeholder="Confirm Password">
                            <input type="submit" class="btn" value="Register"></input>
                        </form>
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
    </div>
    <!------------ JS for toggle form ------------>
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
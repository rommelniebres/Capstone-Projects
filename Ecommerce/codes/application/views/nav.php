<div class="container">
    <div class="navbar">
        <a href="<?=base_url();?>home/index"><img src="https://storage.cloud.google.com/ecommerce-capstone/images/logo.png" class="logo" alt="logo"></a>
        <nav>
            <ul id="MenuItems">
                <li><a href="<?=base_url();?>home/index">Home</a></li>
                <li><a href="<?=base_url();?>products">Product</a></li>
                <li><a href="<?=base_url();?>users/account">Account</a></li>
<?php       if($this->session->userdata('user_id')) { ?>
                <li><a href="<?=base_url();?>users/logout">Logout</a></li>
<?php       } ?>
            </ul>
        </nav>
        <a href="<?=base_url();?>users/cart"><img src="https://storage.cloud.google.com/ecommerce-capstone/images/cart.png" class="cart"></a>
        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/menu.png" class="menu-icon" onclick="menuToggle()">
        <p class="cart-count"><?= $this->session->userdata('cart_count')?></p>
    </div>
</div>

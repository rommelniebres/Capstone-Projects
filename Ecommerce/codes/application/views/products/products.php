<?php 
$title = "Products";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>


<body>
    <!------------ Nav -------------->
    <?php include($dir.'/nav.php'); ?>
    <!---------- Search form ---------->
    <div class="small-container product-list">
        <div class="search-form">
            <form action="<?=base_url();?>products/search" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <input type="text" class="search" placeholder="Search Product" name="search">
                <input type="submit" class="btn" value="Search"></input>
            </form>
        </div>
        <div class="row row-2">
            <h2>All Products</h2>
            <select>
                <option>Default Sorting</option>
                <option>Sort by price</option>
                <option>Sort by popularity</option>
                <option>Sort by rating</option>
                <option>Sort by sale</option>
            </select>
        </div>
        <!---------- Product List ---------->
        <div class="row">
<?php   foreach($products as $product) { ?>
            <div class="col-4">
                <a href="<?=base_url();?>products/product/<?= $product['id'] ?>">
                    <img src="<?= $product['url'] ?>">
                </a>
                <h4><?= $product['name'] ?></h4>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <p>$<?= $product['price'] ?></p>
            </div>
<?php   } ?>
    </div>
    <div class="page-btn">
        <span>1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <span>5</span>
        <span>6</span>
        <span>7</span>
        <span>&#8594;</span>
    </div>
    <!---------- Categories ---------->
    <div class="row row-2">
        <h2>Categories</h2>
    </div>
    <div class="row">
<?php  
    foreach($categories as $category) { ?>
        <div class="col-4">
            <a href="<?=base_url();?>products/category/<?= $category['id'] ?>">
                <img src="<?= $category['url'] ?>" alt="">
                <h4><?= $category['name'] ?></h4>
            </a>
        </div>
<?php   
    } ?>
    </div>
    <!------------ Footer -------------->
    <?php include($dir.'/footer.php'); ?>
    <!-- js for toggle menu -->
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
</body>

</html>
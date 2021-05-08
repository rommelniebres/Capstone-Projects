<?php 
$title = "Product";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>


<body>
    <!------------ Nav -------------->
    <?php include($dir.'/nav.php'); ?>
    <!------------ single product details  ------------>
    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
<?php       foreach($products as $product) { ?>
                <img src="<?= $product['url'] ?>" class="gallery" id="ProductImg">
                <div class="small-img-row">
<?php           foreach($url as $image) { ?>
                    <div class="small-img-col">
                        <img src="<?= $image['url'] ?>" class="gallery small-img">
                    </div>                    
<?php           } ?>
                </div>
            </div>
            <div class="col-2">
                <p><?= ucfirst($product['category']) ?></p>
                <h1><?= ucfirst($product['name']) ?></h1>
                <h4>$<?= $product['price'] ?></h4>
                <form class="quantity-input" action="<?=base_url();?>users/add_to_cart" method="post">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="number" value="1" name="quantity" min="1">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="submit" value="Add to Cart" class="btn">
                </form>
                <p class="cart-update"><?= $this->session->flashdata('success');?></p>
                <h3>Product Details<i class="fas fa-info"></i></h3>
                <p><?= ucfirst($product['description']) ?></p>
            </div>
<?php       } ?>
        </div>
    </div>
    <!------------ Title  ------------>
    <div class="small-container">
        <div class="row row-2">
            <h2>Similar Products</h2>
        </div>

    </div>
    <!------------ Product  ------------>
    <div class="small-container">
        <div class="row">
<?php   foreach($similars as $similar) { ?>
            <div class="col-4">
                <a href="<?=base_url();?>products/product/<?= $similar['id'] ?>">
                    <img src="<?= $similar['url'] ?>">
                </a>
                <h4><?= ucfirst($similar['name']) ?></h4>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <p>$<?= $similar['price'] ?></p>
            </div>
<?php   } ?>
        </div>
    </div>

    <!------------ footer -------------->
    <?php include($dir.'/footer.php'); ?>
    <!------------ js for toggle menu  ------------>
    <script>
        $(".cart-update").fadeIn().delay(2000).fadeOut();
    </script>
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
    <!------------ js for product gallery  ------------>
    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");
        SmallImg[0].onclick = function () {
            ProductImg.src = SmallImg[0].src;
        }
        SmallImg[1].onclick = function () {
            ProductImg.src = SmallImg[1].src;
        }
        SmallImg[2].onclick = function () {
            ProductImg.src = SmallImg[2].src;
        }
        SmallImg[3].onclick = function () {
            ProductImg.src = SmallImg[3].src;
        }
    </script>
</body>

</html>
<?php 
$title = "Cart";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>
<body>
    <!------------ Nav -------------->
    <?php include($dir.'/nav.php'); ?>
    <!------------ Cart Items Details -------------->
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            
<?php       $total = 0;
            $subtotal = 0;
            $tax = 0.1;
            foreach($items as $item) { ?>
            <tr>  
                <td>
                    <div class="cart-info">
                        <img src="<?= $item['url'] ?>">
                        <div>
                            <p><?= ucfirst($item['name']) ?></p>
                            <a href="<?=base_url();?>users/delete_cart/<?= $item['id'] ?>">Remove</a>
                        </div>
                    </div>
                </td>
                <td>$<?= $item['price'] ?></td>
                <td>
                    <form class="quantity-input" action="" method="post">
                        <input type="number" value="<?= $item['quantity'] ?>" min="1" max="999">
                    </form>
                </td>
                <td>$<?= floatval($item['price'])*floatval($item['quantity']) ?> </td> 
<?php           $subtotal += floatval($item['price']) * floatval($item['quantity']);?>
            </tr>  
<?php       }
            $tax = floor(($subtotal * $tax)*100)/100;
            $total = $subtotal + $tax;
?>
        </table>
        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$<?= $subtotal ?></td>
                </tr>
                <tr>
                    <td>Tax(10%)</td>
                    <td>$<?= $tax ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$<?= $total ?></td>
                </tr>
            </table>
        </div>
    </div>
    <form action="<?=base_url();?>users/checkout" method="post">
        <input type="submit" class="btn" value="Check Out" id="checkout">
    </form>
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
        $(document).on("change", "#search", function(e) {
                $.post($(this).attr('action'), $(this).serialize(), function(res) {
                    $('table#users').html(res);
                });
			return false;
			});
    </script>
</body>

</html>
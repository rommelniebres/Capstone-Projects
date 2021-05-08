<?php 
$title = "Dashboard Order";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>

<body>
    <!------------ Nav -------------->
    <?php include('admin_nav.php'); ?>
    <div class="small-container cart-page">
        <div class="row row-2">
            <div class="col-2">
                <h3>Order ID: 1</h3>
                <h4>Customer shipping info:</h4>
                <p>Name: Bob</p>
                <p>Address: 123 dojo way</p>
                <p>City: Seattle</p>
                <p>State: WA</p>
                <p>Zip: 91298</p>
                <hr>
                <h4>Customer billing info</h4>
                <p>Name: Bob</p>
                <p>Address: 123 dojo way</p>
                <p>City: Seattle</p>
                <p>State: WA</p>
                <p>Zip: 91298</p>
            </div>
            <table class="col-2">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <tr class="order-list">
                    <td>1</td>
                    <td>Shoe</td>
                    <td>123</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                <tr class="order-list">
                    <td>1</td>
                    <td>Shoe</td>
                    <td>123</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                <tr class="order-list">
                    <td>1</td>
                    <td>Shoe</td>
                    <td>123</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <p class="status">Status: Shipped</p>
                    </td>
                    <td>
                        <p>Sub total: $28.99</p>
                        <p> Shipping: $2</p>
                        <p>Total: $20.99</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!---------- js for toggle menu ---------->
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
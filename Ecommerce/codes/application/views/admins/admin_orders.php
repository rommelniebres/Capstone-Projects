<?php 
$title = "Dashboard Orders";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>

<body>
    <!------------ Nav -------------->
    <?php include('admin_nav.php'); ?>
    <!---------- Orders List ---------->
    <div class="small-container cart-page">
        <div class="search-form">
            <form action="">
                <input type="text" class="search" placeholder="Search Product">
                <input type="submit" class="btn" value="Search"></input>
            </form>
        </div>
        <div class="row row-2">
            <h2>Orders</h2>
            <select>
                <option>Show All</option>
                <option>Order in process</option>
                <option>Shipped</option>
                <option>Cancelled</option>
            </select>
        </div>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Billing Address</th>
                <th>Shipping Address</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            <tr class="order-list">
                <td><a href="<?=base_url();?>admins/order">100</a></td>
                <td>Bob</td>
                <td>9/6/2021</td>
                <td>123 dojo high way beluieve wa 120831290</td>
                <td>shipping sdas dojo high way beluieve wa 120831290</td>
                <td>$120.00</td>
                <td>
                    <select>
                        <option>Order in process</option>
                        <option>Shipped</option>
                        <option>Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr class="order-list">
                <td><a href="<?=base_url();?>admins/order">100</a></td>
                <td>Bob</td>
                <td>9/6/2021</td>
                <td>123 dojo high way beluieve wa 120831290</td>
                <td>shipping sdas dojo high way beluieve wa 120831290</td>
                <td>$120.00</td>
                <td>
                    <select>
                        <option>Order in process</option>
                        <option>Shipped</option>
                        <option>Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr class="order-list">
                <td><a href="<?=base_url();?>admins/order">100</a></td>
                <td>Bob</td>
                <td>9/6/2021</td>
                <td>123 dojo high way beluieve wa 120831290</td>
                <td>shipping sdas dojo high way beluieve wa 120831290</td>
                <td>$120.00</td>
                <td>
                    <select>
                        <option>Order in process</option>
                        <option>Shipped</option>
                        <option>Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr class="order-list">
                <td><a href="<?=base_url();?>admins/order">100</a></td>
                <td>Bob</td>
                <td>9/6/2021</td>
                <td>123 dojo high way beluieve wa 120831290</td>
                <td>shipping sdas dojo high way beluieve wa 120831290</td>
                <td>$120.00</td>
                <td>
                    <select>
                        <option>Order in process</option>
                        <option>Shipped</option>
                        <option>Cancelled</option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="page-btn pagination">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>&#8594;</span>
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
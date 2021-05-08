<?php 
$title = "Account";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>


<body>
    <!------------ Nav -------------->
    <?php include($dir.'/nav.php'); ?>
    <!------------ Shipping Form -------------->
    <div class="small-container shipping-info-bg">
        <div class="row shipping-billing-row">
            <div class="col-2">
                <form action="<?=base_url();?>users/shipping_info" class="shipping-info" method="POST">
                    <h2>Shipping Information</h2>
                    <div class="table-row">
                        <label for="first-name">First Name:</label>
                        <input type="text" name="first_name" id="first-name" value="">
                    </div>
                    <div class="table-row">
                        <label for="last-name">Last Name:</label>
                        <input type="text" name="last_name" id="last-name">
                    </div>
                    <div class="table-row">
                        <label for="address">Phone number:</label>
                        <input type="text" name="phone_number" id="address">
                    </div>
                    <div class="table-row">
                        <label for="address2">Region:</label>
                        <input type="text" name="region" id="address2">
                    </div>
                    <div class="table-row">
                        <label for="city">Province:</label>
                        <input type="text" name="province" id="city">
                    </div>
                    <div class="table-row">
                        <label for="state">City:</label>
                        <input type="text" name="city" id="state">
                    </div>
                    <div class="table-row">
                        <label for="state">Barangay:</label>
                        <input type="text" name="barangay" id="state">
                    </div>
                    <div class="table-row">
                        <label for="state">Street:</label>
                        <input type="text" name="street" id="state">
                    </div>
                    <div class="table-row">
                        <label for="zip-code">Postal Code:</label>
                        <input type="text" name="postal_code" id="zip-code">
                    </div>
                    <input type="hidden" name="is_shipping" value="1">
                    <input type="hidden" name="is_billing" value="0">
                    <div class="table-row">
                        <label for="same-as-shipping" class="small-text">Same as Billing:</label>
                        <input type="checkbox" id="same-as-shipping" name="is_billing" value="1">
                    </div>
                    <input type="submit" id="save-shipping" class="btn" value="Save">
                </form>
            </div>
            <!------------ Billing Form -------------->
            <div class="col-2 user-billing">
                <form action="<?=base_url();?>users/shipping_info" class="shipping-info" method="post">
                    <h2>Billing Information</h2>
                    <div class="table-row">
                        <label for="first-name">First Name:</label>
                        <input type="text" name="first_name" id="first-name" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="last-name">Last Name:</label>
                        <input type="text" name="last_name" id="last-name" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="address">Phone number:</label>
                        <input type="text" name="phone_number" id="phone" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="address2">Region:</label>
                        <input type="text" name="region" id="address2" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="city">Province:</label>
                        <input type="text" name="province" id="city" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="state">City:</label>
                        <input type="text" name="city" id="state" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="state">Barangay:</label>
                        <input type="text" name="barangay" id="state" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="state">Street:</label>
                        <input type="text" name="street" id="state" class="billing-input">
                    </div>
                    <div class="table-row">
                        <label for="zip-code">Postal Code:</label>
                        <input type="text" name="postal_code" id="zip-code" class="billing-input">
                    </div>
                    <input type="hidden" name="is_shipping" value="0">
                    <input type="hidden" name="is_billing" value="1">
                    <input type="submit" id="save-billing" class="btn billing-input" value="Save">
                </form>
            </div>
        </div>
        <div class="status-validation-dark">
            <?=$this->session->flashdata('status');?>
        </div>
        <div class="status-validation-success">
            <?=$this->session->flashdata('success');?>
        </div>
    </div>
    <!------------ footer -------------->
    <?php include($dir.'/footer.php'); ?>
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
        $(document).on("change", "#same-as-shipping", function(e) {
            if ($('#same-as-shipping').is(':checked') == true){
                $('.billing-input').prop('disabled', true);
            } else {
                $('.billing-input').prop('disabled', false);
            }
			});
    </script>
</body>

</html>
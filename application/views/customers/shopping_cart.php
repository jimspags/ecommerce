<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href = "https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/shopping-cart-style.css"/>

    </head>
    <script>
        $(document).ready(function() {

            fetch_shopping_cart();
            function fetch_shopping_cart() {
                $.get("customers/fetch_shopping_cart", function(data) {
                    $("section#table").html(data);
                });
            }

            // Set value for input month
            $("input[name='expiration']").val($("#expiration_value").val());

            $("#message-dialog").dialog({
                autoOpen: false
            });
            $('#message-dialog').on('dialogclose', function(event) {
                location.href="order_history.html";
            });
            function toggleQtyField(qtyField) {
                if($(qtyField).hasClass("non-editable-qty")) {
                    $(qtyField).attr("class","editable-qty");
                } else {
                    $(qtyField).attr("class","non-editable-qty");
                }
            }

            $(document).on('click', "img", function() {
                if (confirm($(this).attr('product-name') + " will be deleted. Click to confirm.")) {
                    $.post($(this).parent().attr("action"), $(this).parent().serialize(), function(data) {
                        console.log(JSON.parse(data).status);
                        fetch_shopping_cart();
                    });
                    alert($(this).attr('product-name')+" is now deleted.");
                }
            });

            //submit the form for twice button click
            $(document).on('click', "button#update", function() {
                toggleQtyField($(this).siblings('input'));
                if($(this).attr('clicks') == '0') {
                    $(this).attr('clicks', "1");
                    return false;
                }else if ($(this).attr('clicks') == "1") {
                    console.log($(this).parent().children("input[name='quantity']").val());
                    $.post($(this).parent().attr("action"), $(this).parent().serialize(), function(data) {
                    fetch_shopping_cart();
                    });
                    $(this).attr('clicks', "0");

                }

            });

            $(document).on('click', "#pay_button", function() {
                $("#message-dialog").dialog("open");
                return false;
            });
        });
    </script>
    <body>
        <header>
            <a href="<?= base_url() ?>">Dojo eCommerce</a>

<?php
    if($this->session->userdata("is_logged_in") == "1") {
?>
            <a href="<?= base_url() ?>logoff">Log off</a>
            <a href="<?= base_url() ?>profile">Settings</a>
<?php
    } else {
?>
            <a href="<?= base_url() ?>login">Login</a>
<?php
    }
?>
            <a href="<?= base_url() ?>cart">Shopping Cart (5)</a>

        </header>  
        <a href="<?= base_url() ?>order_history">View Order History</a>
        
        <div id="message-dialog">Order success!</div>
        <section id="table">

        </section>
        <form>
            <h3>Shipping Information</h3>

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?= !empty($shipping['first_name']) ? $shipping['first_name'] : '' ?>"/>

            <label for="city">City:</label>
            <input type="text" name="city" value="<?= !empty($shipping['city']) ? $shipping['city'] : '' ?>"></textarea>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?= !empty($shipping['last_name']) ? $shipping['last_name'] : '' ?>" />

            <label for="state">State:</label>
            <input type="text" name="state" value="<?= !empty($shipping['state']) ? $shipping['state'] : '' ?>">

            <label for="address1">Address:</label>
            <textarea name="address1"><?= !empty($shipping['address']) ? $shipping['address'] : '' ?></textarea>

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="zipcode" value="<?= !empty($shipping['zipcode']) ? $shipping['zipcode'] : '' ?>">

            <label for="address">Address 2:</label>
            <textarea name="address2"><?= !empty($shipping['address_2']) ? $shipping['address_2'] : '' ?></textarea>
            <!----------------------------------->
            <h3>Billing Information</h3>

            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?= !empty($billing['first_name']) ? $billing['first_name'] : '' ?>" />
            
            <label for="state">State:</label>
            <input type="text" name="state" value="<?= !empty($billing['state']) ? $billing['state'] : '' ?>">

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?= !empty($billing['last_name']) ? $billing['last_name'] : '' ?>"/>

            <label for="zipcode">Zipcode:</label>
            <input type="text" name="zipcode" value="<?= !empty($billing['zipcode']) ? $billing['zipcode'] : '' ?>">

            <label for="address1">Address:</label>
            <textarea name="address1"><?= !empty($billing['address']) ? $billing['address'] : '' ?></textarea>

            <label for="card">Card:</label>
            <input type="text" name="card" value="<?= !empty($billing['card_name']) ? $billing['card_name'] : '' ?>">

            <label for="address">Address 2:</label>
            <textarea name="address2"><?= !empty($billing['address_2']) ? $billing['address_2'] : '' ?></textarea>

            <label for="security_code">Card Security Code:</label>
            <input type="password" name="security_code" value="<?= !empty($billing['security_code']) ? $billing['security_code'] : '' ?>">

            <label for="city">City:</label>
            <input type="text" name="city" value="<?= !empty($billing['city']) ? $billing['city'] : '' ?>">
            <input type="hidden" id="expiration_value" value="<?= !empty($billing['expiration']) ? substr($billing['expiration'], 0, 7) : '' ?>">

            <label for="expiration">Card Expiration:</label>
            <input type="month" name="expiration">

            <input type="submit" id="pay_button" value="Pay">
        </form>

    </body>
</html>
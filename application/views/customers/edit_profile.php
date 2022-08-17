<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link href = "https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/edit-profile-style.css"/>
        <script>
            $(document).ready(function() {
                $("#message-dialog").dialog({
                    autoOpen: false
                });

                $(document).on('click', 'input[type="submit"]', function() {
                    let message = $(this).attr("message"); // Get message from the button
                    $.post($(this).parent().attr("action"), $(this).parent().serialize(), function(data) {
                        $("#errors").html("");
                        $("#form_password")[0].reset();
                        if(JSON.parse(data).status == 400) {
                            $("#errors").html(JSON.parse(data).errors);
                        }

                        if(JSON.parse(data).status == 200) {
                            $('#message-dialog').html(message);
                            $("#message-dialog").dialog("open");
                            console.log(JSON.parse(data));
                        }

                        
                    });
                    return false;
                });
            });
        </script>
    </head>
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
        <div id="message-dialog"></div>
        <div id="errors"></div>

        <fieldset>            
            <legend>Edit Password</legend>
            <form action="<?= base_url() ?>profile/edit_password" method="POST" id="form_password">
                <label for="old_password">Old Password:</label>
                <input type="password" name="old_password" />
    
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" />
    
                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" name="confirm_new_password" />
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <input type="submit" message="Password successfully updated!" value="Save">
            </form>
        </fieldset>

        <fieldset>
            <legend>Edit Default Shipping</legend>
            <form action="<?= base_url() ?>profile/default_shipping" method="POST">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="<?= !empty($shipping['first_name']) ? $shipping['first_name'] : '' ?>"/>

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="<?= !empty($shipping['last_name']) ? $shipping['last_name'] : '' ?>" />

                <label for="address1">Address:</label>
                <textarea name="address1"><?= !empty($shipping['address']) ? $shipping['address'] : '' ?></textarea>
                
                <label for="address">Address 2:</label>
                <textarea name="address2"><?= !empty($shipping['address_2']) ? $shipping['address_2'] : '' ?></textarea>

                <label for="city">City:</label>
                <input type="text" name="city" value="<?= !empty($shipping['city']) ? $shipping['city'] : '' ?>"></textarea>

                <label for="state">State:</label>
                <input type="text" name="state" value="<?= !empty($shipping['state']) ? $shipping['state'] : '' ?>">

                <label for="zipcode">Zipcode:</label>
                <input type="text" name="zipcode" value="<?= !empty($shipping['zipcode']) ? $shipping['zipcode'] : '' ?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <!-- Pass to be determined by check_existence function if the info of the user exist in a table -->
                <input type="hidden" name="table" value="shipping_information">
                <input type="submit" message="Shipping information successfully updated!" value="Save">
            </form>
        </fieldset>

        <fieldset>
            <legend>Edit Default Billing</legend>
            <form action="<?= base_url() ?>profile/default_billing" method="POST">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="<?= !empty($billing['first_name']) ? $billing['first_name'] : '' ?>" />
                
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="<?= !empty($billing['last_name']) ? $billing['last_name'] : '' ?>"/>

                <label for="address1">Address:</label>
                <textarea name="address1"><?= !empty($billing['address']) ? $billing['address'] : '' ?></textarea>
                
                <label for="address">Address 2:</label>
                <textarea name="address2"><?= !empty($billing['address_2']) ? $billing['address_2'] : '' ?></textarea>

                <label for="city">City:</label>
                <input type="text" name="city" value="<?= !empty($billing['city']) ? $billing['city'] : '' ?>">

                <label for="state">State:</label>
                <input type="text" name="state" value="<?= !empty($billing['state']) ? $billing['state'] : '' ?>">
    
                <label for="zipcode">Zipcode:</label>
                <input type="text" name="zipcode" value="<?= !empty($billing['zipcode']) ? $billing['zipcode'] : '' ?>">
    
                <label for="card">Card:</label>
                <input type="text" name="card" value="<?= !empty($billing['card_name']) ? $billing['card_name'] : '' ?>">
    
                <label for="security_code">Card Security Code:</label>
                <input type="text" name="security_code" value="<?= !empty($billing['security_code']) ? $billing['security_code'] : '' ?>">
    
                <label for="expiration">Card Expiration:</label>

                <input type="hidden" id="expiration_value" value="<?= !empty($billing['expiration']) ? substr($billing['expiration'], 0, 7) : '' ?>">

                <input type="month" name="expiration" >

                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                <!-- Pass to be determined by check_existence function if the info of the user exist in a table -->
                <input type="hidden" name="table" value="billing_information">
                <input type="submit" message="Billing information successfully updated!" value="Save">
            </form>
        </fieldset>
    <script>
        $(document).ready(function() {
            // Set value for input month
            $("input[name='expiration']").val($("#expiration_value").val());
        });
    </script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/order-history-style.css"/>
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
            <a href="<?= base_url() ?>cart">Shopping Cart (<?= !empty($this->session->userdata("cart_count")) ? $this->session->userdata("cart_count") : 0?>)</a>

        </header> 
        <h3>ORDER HISTORY</h3>  
        <table>
            <thead>
                <tr>
                    <td>Order ID</td>
                    <td>Shipped to</td>
                    <td>Date</td>
                    <td>Billing Address</td>
                    <td>Total</td>
                    <td>Status Order</td>
                </tr>                
            </thead>
            <tbody>
                <tr>
                    <td><a href="<?= base_url() ?>order_history_detail/1">101</a></td>
                    <td>Marlon</td>
                    <td>9/12/2020</td>
                    <td>456 Steve Street, Marikina City</td>
                    <td>$10.00</td>
                    <td>Cancelled</td>
                </tr>
                <tr>
                    <td><a href="./order_history_details.html">100</a></td>
                    <td>Karen</td>
                    <td>8/27/2020</td>
                    <td>123 Commmonwealth, Quezon City</td>
                    <td>$15.00</td>
                    <td>Shipped</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
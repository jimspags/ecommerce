<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/order-history-details-style.css"/>

    </head>
    <body>
        <header>
            <a href="<?= base_url() ?>">Dojo eCommerce</a>
            <a href="<?= base_url() ?>logoff">Log off</a>
            <a href="<?= base_url() ?>profile">Settings</a>
            <a href="<?= base_url() ?>cart">Shopping Cart (5)</a>
        </header>  
        <summary>
            <h3>Order ID: 1</h3>
            <strong>Customer Shipping Info:</strong>
            <p>Name: Bob</p>
            <p>Address: 123 Dojo</p>
            <p>City: Seattle</p>
            <p>State: WA</p>
            <p>Zip: 1121</p>

            <strong>Customer Billing Info:</strong>
            <p>Name: Bob</p>
            <p>Address: 123 Dojo</p>
            <p>City: Seattle</p>
            <p>State: WA</p>
            <p>Zip: 1121</p>            
        </summary>
        <section>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Item</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>                
                </thead>
                <tbody>
                    <tr>
                        <td>35</td>
                        <td>Cup</td>
                        <td>$9.99</td>
                        <td>1</td>
                        <td>$9.99</td>
                    </tr>
                    <tr>
                        <td>215</td>
                        <td>Shirt</td>
                        <td>$19.99</td>
                        <td>1</td>
                        <td>$19.99</td>
                    </tr>
                </tbody>
            </table>
            <p>Status: Shipped</p>
            <div>
                <p>Subtotal: $29.98</p>
                <p>Shipping: $1.00</p>
                <p>Total Price: $30.98</p>
            </div>
        </section>
    </body>
</html>
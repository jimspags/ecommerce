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
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/product-details-style.css"/>

        <script>
            $(document).ready(function() {
                $("#image-preview-dialog").dialog({
                    autoOpen: false
                });
                // image modal 
                $("img.mini-image").on("click", function() {
                    $("#image-preview-dialog img").attr("src", $(this).attr("src"));
                    $("#image-preview-dialog").dialog("open");
                });
                //auto-compute upon changing quantity
                $("input[type='number']").on("change", function() {
                    originalPrice = $(this).siblings("span").attr("orig-price");
                    $(this).siblings("span").text("($"+(originalPrice*$(this).val()).toFixed(2)+")");
                    
                    
                });
                //display notif after submission
                $(document).on('submit', 'form', function() {
                    $("input[name='total']").val($("input[name='quantity']").val() * <?= $product['price'] ?>);
                    $.post($(this).attr("action"), $(this).serialize(), function(data) {
                        if(JSON.parse(data).status == 200) {
                            $("main em").fadeIn(1000);
                            $("main em").fadeOut(5000);
                        }
                    });
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <div id="image-preview-dialog">
            <img src=""/>
        </div>
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
        <main>
            <a href="<?= base_url() ?>">Go Back</a>
            <h1><?= $product['product_name'] ?></h1>
            <figure>
                <img class="mini-image" src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                <img class="mini-image" src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                <img class="mini-image" src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                <img class="mini-image" src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                <img class="mini-image" src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                <img class="mini-image" src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
            </figure>
            <p><?= $product['description'] ?></p>

            <form action="<?= base_url() ?>add_to_cart" method="POST">
                <span orig-price="<?= $product['price'] ?>">($<?= $product['price'] ?>)</span>
                <input type="number" name="quantity" value="1" min="1">
                <input type="hidden" name="total" id="total">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <input type="submit" value="Buy" />
            </form>
            <em>Item added to the cart!</em>
        </main>

        <!-- Relate Products -->
        <footer>
            <h2>Similar Items</h2>
<?php
    foreach($similar_items as $similar_item) {
?>
            <figure>
                <a href="">
                    <img src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                    <p>$<?= $similar_item['price'] ?></p>
                    <figcaption><?= $similar_item['product_name'] ?></figcaption>
                </a>
            </figure>
<?php
    }
?>
        </footer>

    </body>
</html>
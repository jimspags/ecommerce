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
                    $("main em").fadeIn(1000);
                    $("main em").fadeOut(5000);
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
            <a href="<?= base_url() ?>logoff">Log off</a>
            <a href="<?= base_url() ?>profile">Settings</a>
            <a href="<?= base_url() ?>cart">Shopping Cart (5)</a>
        </header>  
        <main>
            <a href="./catalog.html">Go Back</a>
            <h1>Magnifying Glass</h1>
            <figure>
                <img class="mini-image" src="img/magnifying_glass.png"/>
                <img class="mini-image" src="img/magnifying_glass.png"/>
                <img class="mini-image" src="img/magnifying_glass.png"/>
                <img class="mini-image" src="img/magnifying_glass.png"/>
                <img class="mini-image" src="img/magnifying_glass.png"/>
                <img class="mini-image" src="img/magnifying_glass.png"/>
            </figure>
            <p>Duis efficitur arcu in lacus aliquet, vel iaculis elit pulvinar. Ut tempus enim vel ultrices tristique. Donec neque augue, elementum ac facilisis ut, imperdiet a purus. Etiam tincidunt volutpat quam, sit amet feugiat turpis. In sed dui dictum, facilisis mi et, egestas augue. Pellentesque magna velit, eleifend vitae ex eget, interdum tristique eros. Aliquam ultrices luctus pellentesque. Fusce porta non sapien non feugiat. Donec elementum non nisi non sagittis. Aliquam semper arcu id metus vulputate, ac iaculis magna laoreet. Phasellus facilisis varius ipsum, eget tincidunt purus rhoncus eu. Pellentesque tortor justo, fringilla quis bibendum nec, cursus vel enim.</p>
            <form>
                <span orig-price="19.99">($19.99)</span>
                <input type="number" name="quantity" value="1" min="1">
                <input type="submit" value="Buy" />
            </form>
            <em>Item added to the cart!</em>
        </main>

        <!-- Relate Products -->
        <footer>
            <h2>Similar Items</h2>
            <figure>
                <a href="">
                    <img src="./img/magnifying_glass.png"/>
                    <p>$12.99</p>
                    <figcaption>Magnifying Glass</figcaption>
                </a>
            </figure>
            <figure>
                <a href="./product_details.html">
                    <img src="./img/magnifying_glass.png"/>
                    <p>$13.99</p>
                    <figcaption>Magnifying Glass</figcaption>
                </a>
            </figure>
            <figure>
                <a href="./product_details.html">
                    <img src="./img/magnifying_glass.png"/>
                    <p>$10.99</p>
                    <figcaption>Magnifying Glass</figcaption>
                </a>
            </figure>
            <figure>
                <a href="./product_details.html">
                    <img src="./img/magnifying_glass.png"/>
                    <p>$101.99</p>
                    <figcaption>Magnifying Glass</figcaption>
                </a>
            </figure>
            <figure>
                <a href="./product_details.html">
                    <img src="./img/magnifying_glass.png"/>
                    <p>$2.99</p>
                    <figcaption>Magnifying Glass</figcaption>
                </a>
            </figure>
            <figure>
                <a href="./product_details.html">
                    <img src="./img/magnifying_glass.png"/>
                    <p>$3.99</p>
                    <figcaption>Magnifying Glass</figcaption>
                </a>
            </figure>
        </footer>

    </body>
</html>
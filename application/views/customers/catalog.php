<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/catalog-style.css"/>

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
        <form action="./search-keyword.html" method="POST">
            <div>
                <img src='./img/magnifying_glass.png' />
                <input type="search" name="search_keyword" placeholder="search">
            </div>
            <ul>
                <strong>Categories</strong>
                <li><a href="#">Tshirts (25)</a></li>
                <li><a href="#">Cups (25)</a></li>
                <li><a href="#">Fruits (25)</a></li>
                <li><a href="#">Show All</a></li>
            </ul>
        </form>
        <main>
            <h2>All Products (page 2)</h2>
            <nav>
                <a href="#">first</a>
                <a href="#">prev</a>
                <span>2</span>
                <a href="#">next</a>
            </nav>
            <form action="#">
                <label for="sorted_by">Sorted by</label>
                <select name="sorted_by">
                    <option value="price" selected>Price</option>
                    <option value="most_popular">Most Popular</option>
                </select>
            </form>
            <!-- Display Products -->
            <section>
                <figure>
                    <a href="<?= base_url() ?>product/1">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="#">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure><figure>
                    <a href="./product_details.html">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="#">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure><figure>
                    <a href="./product_details.html">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="#">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="./product_details.html">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="#">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="#">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
                <figure>
                    <a href="#">
                        <img src="./img/magnifying_glass.png"/>
                        <p>$1.99</p>
                        <figcaption>Magnifying Glass</figcaption>
                    </a>
                </figure>
            </section>
            <footer>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">&#8594;</a>
            </footer>
        </main>
    </body>
</html>
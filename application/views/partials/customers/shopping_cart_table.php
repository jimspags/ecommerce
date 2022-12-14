<table>
                <thead>
                    <tr>
                        <td>Item</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>                
                </thead>
                <tbody>
<?php

    $items = 0;
    foreach($carts as $cart) {
    $items++;
?>
                    <tr>
                        <td><?= $cart['product_name'] ?></td>
                        <td>$<?= $cart['price'] ?></td>
                        <td>
                            <form action="<?= base_url() ?>update_cart_quantity" method="POST" id="update_form">
                                <input type="number" name="quantity" min="1" class="non-editable-qty" value="<?= $cart['quantity'] ?>"/> <button clicks="0" type="button" id="update">update</button>
                                <input type="hidden" name="cart_id" value="<?= $cart['id'] ?>">    
            
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                            </form>

                            <form action="<?= base_url() ?>delete_from_cart" method="POST" id="delete_form">
                                <input type="hidden" name="cart_id" value="<?= $cart['id'] ?>">    
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                <img product-name="Black Belt for Staff" src="<?= base_url() ?>assets/img/trash-can.png"/></form></td>
                            </form>
                        <td>$<?= $cart['total'] ?></td>
                    </tr>
                    
<?php
    
    
    }
    if($items == 0) {
?>
                        <td colspan="4" style="text-align: center">No item added</td>
<?php
    }
?>
                </tbody>
            </table>
            <p class="amounts">Subtotal: $<?= $this->session->userdata("amount")['subtotal'] ?></p><br>
            <p class="amounts">Shipping Fee: $<?= $this->session->userdata("amount")['shipping_fee'] ?></p><br> <!-- Fixed Shipping Fee by 1 dollar -->
            <p class="amounts">Total: $<?= $this->session->userdata("amount")['total'] ?></p>
            <button type="button" onclick="location.href='<?= base_url() ?>';">Continue Shopping</button>
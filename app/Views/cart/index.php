<div>
    <table class="order-table">
        <tr>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Product Total</th>
        </tr>
        <?php foreach ($cartItems as $cartItem) : ?>
            <tr>
                <td><?= $cartItem['product_name'] ?></td>
                <td><?= $cartItem['product_qty'] ?></td>
                <td><?= $cartItem['product_price'] * $cartItem['product_qty'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="2">Grand total</th>
            <td><?= number_format($grand_total, 2) ?></td>
        </tr>
    </table>
</div>

<div class="contact-form">
    <form action="<?= base_url('cart/checkout') ?>" method="get">
        <div>
            <label for="name">Name: </label>
            <div>
                <input type="text" name="name" id="name" required>
            </div>
        </div>
        <div>
            <label for="email">Email: </label>
            <div>
                <input type="email" name="email" id="email" required>
            </div>
        </div>
        <div>
            <label for="mobile">Mobile: </label>
            <div>
                <input type="text" name="mobile" id="mobile" required>
            </div>
        </div>
        <button type="submit">Checkout</button>
    </form>
</div>
<?= $this->extend('main_layout') ?>
<?= $this->section('content') ?>
<div class="container py-5 my-5">
    <h2 class="mb-4">Shopping Cart</h2>
    <?php
    $subtotal = 0;
    foreach ($cart as $c) {
        $subtotal += $c['price'] * $c['qty'];
    }
    $tax = 0.11 * $subtotal;
    $total = $subtotal + $tax;
    ?>
    <form action="/checkout" method="POST" enctype="multipart/form-data">
        <div class="row my-5 py-3">
            <div class="col-lg-8">
                <?php foreach ($cart as $c) : ?>
                    <div class="cart-item p-3">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="<?= base_url('assets/images/products/' . $c['image']) ?>" alt="<?= $c['name']; ?>" class="product-image">
                            </div>
                            <div class="col-md-4">
                                <h5 class="mb-1"><?= $c['name']; ?></h5>
                                <p class="text-muted mb-0">Category</p>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <span class="btn-quantity">-</span>
                                    <input type="number" class="quantity-input mx-2" id="qty" value="<?= $c['qty']; ?>" min="1" max="">
                                    <span class="btn-quantity">+</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <span class="fw-bold" id="price"><?= format_rupiah($c['price']); ?></span>
                                <!-- <input type="hidden" value="<?= $c['price']; ?>"> -->
                            </div>
                            <div class="col-md-1">
                                <i class="bi bi-trash delete-btn" data-id="<?= $c['id']; ?>"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <hr>

                <div class="text-end mt-3 <?= $cart ? 'd-block' : 'd-none'; ?> clear-cart">
                    <a href="/cart/clear" class="btn btn-danger" id="clear-cart">Clear Cart</a>
                </div>

                <div class="text-center mt-3 <?= $cart ? 'd-none' : 'd-block'; ?> back-home">
                    <p>Your cart is empty</p>
                    <a href="/" class="btn btn-dark">Back to Home</a>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4 class="mb-3">Cart Summary</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span id="subtotal"><?= format_rupiah($subtotal); ?></span>
                    </div>
                    <!-- <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span>$10.00</span>
                    </div> -->
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax</span>
                        <span id="tax"><?= format_rupiah($tax); ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold" id="total"><?= format_rupiah($total); ?></span>
                    </div>
                    <button class="btn btn-dark w-100" type="submit" <?= !$cart ? 'disabled' : ''; ?>>Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        updateTotal();

        // Function untuk update quantity
        $('.btn-quantity').on('click', function() {
            const input = $(this).siblings('.quantity-input');
            let value = parseInt(input.val()) + ($(this).text() === '+' ? 1 : -1);
            if (value < 1) value = 1;
            input.val(value);
            const itemId = $(this).closest('.cart-item').find('.delete-btn').data('id');
            $.ajax({
                url: '/cart/update/' + itemId,
                type: 'POST',
                data: {
                    qty: value
                },
                success: function(response) {
                    updateTotal();
                },
                error: function(xhr, status, error) {
                    console.error('Failed to update item quantity:', error);
                }
            });
        });

        // Function untuk menghapus item
        $('.delete-btn').on('click', function() {
            $(this).closest('.cart-item').remove();
            const itemId = $(this).data('id');
            $.ajax({
                url: '/cart/remove/' + itemId,
                type: 'DELETE',
                success: function(response) {
                    updateTotal();
                },
                error: function(xhr, status, error) {
                    console.error('Failed to remove item from cart:', error);
                }
            });
        });

        function updateTotal() {
            let subtotal = 0;
            $('.cart-item').each(function() {
                const price = parseInt(reformatRupiah($(this).find('#price').text()));
                const quantity = parseInt($(this).find('.quantity-input').val());
                subtotal += price * quantity;
            });
            const tax = 0.11 * subtotal;
            const total = subtotal + tax;
            $('#subtotal').text(formatRupiah(subtotal));
            $('#tax').text(formatRupiah(tax));
            $('#total').text(formatRupiah(total));
            if (total !== 0) {
                $('button[type="submit"]').removeAttr('disabled');
                $('.clear-cart').addClass('d-block').removeClass('d-none');
                $('.back-home').addClass('d-none').removeClass('d-block');
            } else {
                $('button[type="submit"]').attr('disabled', 'disabled');
                $('.clear-cart').addClass('d-none').removeClass('d-block');
                $('.back-home').addClass('d-block').removeClass('d-none');
            }


        }

        function formatRupiah(amount) {
            return 'Rp. ' + amount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function reformatRupiah(text) {
            return text.replace('Rp. ', '').replace(',', '').replace('.', '');
        }
    });
</script>
<?= $this->endSection() ?>
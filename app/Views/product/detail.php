<?= $this->extend('main_layout') ?>
<?= $this->section('content') ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= base_url('assets/images/products/' . $product['image']) ?>" alt="..." /></div>
            <div class="col-md-6">
                <!-- <div class="small mb-1">SKU: BST-498</div> -->
                <h1 class="display-5 fw-bolder"><?= $product['name']; ?></h1>
                <div class="fs-5 mb-5">
                    <?php if ($product['discount'] > 0) : ?>
                        <span class="text-decoration-line-through"><?= format_rupiah($product['price']); ?></span>
                        <span><?= discount_price($product['price'], $product['discount']) ?></span>
                    <?php else : ?>
                        <span><?= format_rupiah($product['price']); ?></span>
                    <?php endif; ?>
                </div>
                <p class="lead"><?= $product['description']; ?></p>
                <form action="<?= base_url('cart/add/' . $product['id']) ?>" method="POST">
                    <div class="d-flex">
                        <span class="btn-quantity">-</span>
                        <input type="number" class="quantity-input mx-2 text-center" name="qty" value="1" min="1" max="<?= $product['stock']; ?>" style="max-width: 3rem">
                        <span class="btn-quantity">+</span>
                        <button class="btn btn-outline-dark flex-shrink-0 mx-2" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php foreach ($related_products as $rp) : ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <a href="<?= base_url('product/' . $rp['id']) ?>" class="text-decoration-none text-dark">
                            <!-- Sale badge-->
                            <?php
                            if ($rp['discount'] > 0) {
                                echo '<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>';
                            }
                            ?>
                            <!-- Product image-->
                            <img class="card-img-top" src="<?= base_url('assets/images/products/' . $rp['image']) ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $rp['name']; ?></h5>
                                    <!-- Product reviews-->
                                    <!-- <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div> -->
                                    <!-- Product price-->
                                    <?php
                                    if ($rp['discount'] > 0) {
                                        echo '<span class="text-muted text-decoration-line-through">' . format_rupiah($rp['price']) . '</span> ' . discount_price($rp['price'], $rp['discount']);
                                    } else {
                                        echo format_rupiah($rp['price']);
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('cart/add/' . $rp['id']) ?>">Add to cart</a></div>
                            </div>
                    </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('.btn-quantity').on('click', function() {
            const input = $(this).siblings('.quantity-input');
            let value = parseInt(input.val()) + ($(this).text() === '+' ? 1 : -1);
            if (value < 1) value = 1;
            input.val(value);
        });
    });
</script>

<?= $this->endSection() ?>
<?= $this->extend('main_layout') ?>
<?= $this->section('content') ?>
<section class="py-5">
    <div class="container px-4 px-lg-5">
        <h1 class="mb-5"><?= $title; ?></h1>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($products as $p) : ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <a href="<?= base_url('product/' . $p['id']) ?>" class="text-decoration-none text-dark">
                            <!-- Sale badge-->
                            <?php
                            if ($p['discount'] > 0) {
                                echo '<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>';
                            }
                            ?>
                            <!-- Product image-->
                            <img class="card-img-top" src="<?= base_url('assets/images/products/' . $p['image']) ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $p['name']; ?></h5>
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
                                    if ($p['discount'] > 0) {
                                        echo '<span class="text-muted text-decoration-line-through">' . format_rupiah($p['price']) . '</span> ' . discount_price($p['price'], $p['discount']);
                                    } else {
                                        echo format_rupiah($p['price']);
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('cart/add/' . $p['id']) ?>">Add to cart</a></div>
                            </div>
                    </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
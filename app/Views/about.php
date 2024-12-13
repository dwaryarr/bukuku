<?= $this->extend('main_layout') ?>
<?= $this->section('content') ?>
<!-- Header - set the background image for the header in the line below-->
<header class="py-5 bg-image-full" style="background-color:black">
    <div class="text-center my-5">
        <img class="img-fluid rounded-circle mb-4 img-thumbnail" src="<?= base_url('assets/images/logo.png'); ?>" alt="BukuKu" style="max-width: 200px;" />
        <h1 class="text-white fs-3 fw-bolder">BukuKu</h1>
        <p class="text-white-50 mb-0">Temukan Inspirasi, Satu Buku Sekaligus!</p>
    </div>
</header>
<!-- Content section-->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2>Tentang Kami</h2>
                <p class="lead">BukuKu.id adalah toko online yang menyediakan berbagai jenis buku, mulai dari fiksi, non-fiksi, hingga buku pelajaran. Dengan pengiriman cepat dan harga bersahabat, BukuKu.id siap menjadi mitra belajar dan hiburan Anda.</p>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
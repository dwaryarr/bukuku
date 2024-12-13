<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?> - BukuKu</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="<?= base_url('assets/css/bootstrap-icons-1.5.0/bootstrap-icons.css'); ?>" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" />
    <!-- JQuery -->
    <script src="<?= base_url('assets/js/jquery-3.7.1.js'); ?>"></script>
    <!-- dataTables -->
    <link href="<?= base_url('assets/css/dataTables.bootstrap5.css'); ?>" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 h5">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?= base_url('assets/images/logo.png'); ?>" alt="BukuKu" style="max-width: 30px;" />
                <span class="brand-text">BukuKu</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Produk</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('products'); ?>">Semua Produk</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('popular-products'); ?>">Produk Terlaris</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('new-arrivals'); ?>">Produk Terbaru</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('about'); ?>">Tentang</a></li>
                </ul>
                <div class="d-flex">
                    <?php if (session()->get('role') != 'admin') { ?>
                        <a href="<?= base_url('cart'); ?>" class="btn btn-outline-dark">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-danger text-white ms-1 rounded-pill"><?= count(session()->get('cart') ?? []); ?></span>
                        </a>
                    <?php } ?>
                    <?php if (session()->get('logged_in')) : ?>
                        <div class="dropdown ms-2">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-person-fill me-1"></i>
                                <?= session()->get('fullname'); ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?= base_url('profil'); ?>">Profil</a></li>
                                <?php if (session()->get('role') == 'admin') {
                                    echo '<li><a class="dropdown-item" href="' . base_url('admin') . '">Admin Dashboard</a></li>';
                                } else {
                                    echo '<li><a class="dropdown-item" href="' . base_url('riwayat-order') . '">Riwayat Order</a></li>';
                                } ?>
                                <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <a href="<?= base_url('login'); ?>" class="btn btn-outline-dark ms-2">
                            <i class="bi-person-fill me-1"></i>
                            Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; BukuKu <?= date('Y'); ?></p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    <!-- dataTables -->
    <script src="<?= base_url('assets/js/dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap5.js') ?>"></script>
</body>

</html>
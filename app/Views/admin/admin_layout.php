<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title; ?> - BukuKu</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="<?= base_url('assets/css/bootstrap-icons-1.5.0/bootstrap-icons.css'); ?>" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('assets/css/admin.css'); ?>" rel="stylesheet" />
    <!-- JQuery -->
    <script src="<?= base_url('assets/js/jquery-3.7.1.js'); ?>"></script>
    <!-- dataTables -->
    <link href="<?= base_url('assets/css/dataTables.bootstrap5.css'); ?>" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">
                <a href="/" class="text-decoration-none text-dark h4">
                    <img src="<?= base_url('assets/images/logo.png'); ?>" alt="BukuKu" style="max-width: 30px;" />
                    <span class="brand-text">BukuKu</span>
                </a>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= (strtolower($title) == 'dashboard admin' ? 'active' : ''); ?>" href="/admin"><i class="bi bi-speedometer"></i> Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= (strtolower($title) == 'orders' ? 'active' : ''); ?>" href="/admin/orders"><i class="bi bi-cart-check-fill"></i> Order</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= (strtolower($title) == 'produk' ? 'active' : ''); ?>" href="/admin/products"><i class="bi bi-bag-fill"></i> Produk</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= (strtolower($title) == 'kategori' ? 'active' : ''); ?>" href="/admin/categories"><i class="bi bi-grid-fill"></i> Kategori</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= (strtolower($title) == 'profil' ? 'active' : ''); ?>" href="/profil"><i class="bi bi-person-circle"></i> Profil</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-dark" id="sidebarToggle"><i class="bi bi-list"></i></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 me-2">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= session()->get('fullname'); ?></a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profil"><i class="bi bi-person-circle"></i> Profil</a>
                                    <a class="dropdown-item" href="/"><i class="bi bi-house"></i> Kembali ke Beranda</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="bi bi-box-arrow-right"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- content -->
            <?= $this->renderSection('content') ?>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Akhiri sesi?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin ingin mengakhiri sesi ini?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url('assets/js/admin.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    <!-- dataTables -->
    <script src="<?= base_url('assets/js/dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap5.js') ?>"></script>
</body>

</html>
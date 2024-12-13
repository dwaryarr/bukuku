<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>
<!-- Page content-->
<div class="container-fluid">
    <h1 class="mt-4"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-bar-chart-line icon me-3 h1"></i>
                        <div>
                            <h5 class="mb-1">Total Penjualan</h5>
                            <h4 class="mb-0"><?= format_rupiah($statistics['total_sales']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people icon me-3 h1"></i>
                        <div>
                            <h5 class="mb-1">Total User</h5>
                            <h4 class="mb-0"><?= number_format($statistics['total_users']) . ' Users'; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-cart icon me-3 h1"></i>
                        <div>
                            <h5 class="mb-1">Total Order</h5>
                            <h4 class="mb-0"><?= number_format($statistics['total_orders']) . ' Orders'; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-bag icon me-3 h1"></i>
                        <div>
                            <h5 class="mb-1">Total Produk</h5>
                            <h4 class="mb-0"><?= number_format($statistics['total_products']) . ' Products'; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Transaksi Order Terbaru</h5>
                    <!-- Tabel pesanan terbaru -->
                    <table id="datatables" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Pembeli</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_orders as $ro) : ?>
                                <tr>
                                    <td><a href="<?= base_url('admin/order-detail/' . $ro['id'])  ?>" class="fw-bold text-decoration-none">#<?= $ro['id']; ?></a></td>
                                    <td><?= $ro['customer_name']; ?></td>
                                    <td><?= format_rupiah($ro['total']); ?></td>
                                    <td><?= status_order($ro['status'], $ro['status_bayar']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card-body">
                <h5 class="mb-3">Top Products</h5>
                <ul class="list-group">
                    <?php foreach ($top_products as $tp) { ?>
                        <a href="<?= base_url('product/' . $tp['id']); ?>" class="text-decoration-none">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><img src="<?= base_url('assets/images/products/' . $tp['image']) ?>" alt="<?= $tp['name']; ?>" style="max-width: 100px;"> <?= $tp['name']; ?> <span class="text-success fw-bold"><?= $tp['sold']; ?> Sold</span> </li>
                        </a>
                    <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
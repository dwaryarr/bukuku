<?= $this->extend('main_layout') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <h1 class="my-4"><?= $title; ?></h1>
        <div class="row">
            <?= $this->include('flashalert') ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-list-check me-2"></i>Daftar Order Anda
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Pembeli</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Dibuat pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $o) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url('order-detail/' . $o['id']); ?>" class="fw-bold text-decoration-none">#<?= $o['id']; ?></a>
                                            </td>
                                            <td><?= $o['customer_name']; ?></td>
                                            <td><?= format_rupiah($o['total']); ?></td>
                                            <td><?= status_order($o['status'], $o['status_bayar']); ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($o['created_at'])); ?></td>
                                            <td>
                                                <a href="<?= base_url('order-detail/' . $o['id']); ?>" class="btn btn-primary btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="card-footer">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
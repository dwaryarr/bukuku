<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>
<!-- Page content-->
<div class="container-fluid">
    <h1 class="my-4"><?= $title; ?></h1>
    <div class="row">
        <?= $this->include('flashalert') ?>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
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
                                        <a href="<?= base_url('admin/order-detail/' . $o['id'])  ?>" class="fw-bold text-decoration-none">#<?= $o['id']; ?></a>
                                    </td>
                                    <td><?= $o['customer_name']; ?></td>
                                    <td><?= format_rupiah($o['total']); ?></td>
                                    <td><?= status_order($o['status'], $o['status_bayar']); ?></td>
                                    <td><?= date('d F Y H:i:s', strtotime($o['created_at'])); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/order-detail/' . $o['id'])  ?>" class="btn btn-primary btn-sm"><i class="bi bi-list"></i> Detail</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $o['id']; ?>"><i class="bi bi-trash"></i> Hapus</a>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?= $o['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $o['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $o['id']; ?>">Hapus Kategori</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus order <span class="fw-bold">"#<?= $o['id']; ?>"</span>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('admin/order/delete/' . $o['id']); ?>" class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
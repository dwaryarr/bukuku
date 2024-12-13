<?= $this->extend('main_layout') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <h1 class="my-4"><?= $title; ?></h1>
        <div class="row">
            <?= $this->include('flashalert') ?>
            <div class="col-lg-12 my-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-list-alt me-1"></i>
                        Order Detail
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Order ID</th>
                                    <td>#<?= $order['id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pembeli</th>
                                    <td><?= $order['customer_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><?= format_rupiah($order['total']); ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?= status_order($order['status'], $order['status_bayar']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bukti Bayar</th>
                                    <td>
                                        <?php if ($order['bukti_bayar'] != null) : ?>
                                            <a href="<?= base_url('assets/images/bukti_bayar/' . $order['bukti_bayar']); ?>" target="_blank">
                                                <img src="<?= base_url('assets/images/bukti_bayar/' . $order['bukti_bayar']); ?>" alt="Bukti Bayar" class="img-thumbnail" style="max-width: 200px;">
                                            </a>
                                        <?php else : ?>
                                            <span class="badge bg-secondary">Belum Upload Bukti Bayar</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td><?= $order['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td><?= $order['updated_at']; ?></td>
                                </tr>
                            </table>

                            <h4>Order Detail</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($order_detail as $od) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $od['product']; ?></td>
                                            <td><?= $od['category']; ?></td>
                                            <td><?= format_rupiah($od['price']) ?></td>
                                            <td><?= $od['quantity']; ?></td>
                                            <td>Rp <?= number_format($od['price'] * $od['quantity'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <?php if ($order['status'] == 0) : ?>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#BayarModal">Bayar Sekarang!</button>

                                <!-- Modal -->
                                <div class="modal fade" id="BayarModal" tabindex="-1" aria-labelledby="BayarModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="BayarModalLabel">Upload Bukti Bayar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url('pembayaran/' . $order['id']); ?>" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="buktiBayar" class="form-label">Informasi Pembayaran</label>
                                                        <p>Pembayaran hanya melalui nomor rekening berikut:</p>
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td>Bank Tujuan</td>
                                                                <td>:</td>
                                                                <td class="fw-bold">Bank BCA</td>
                                                            </tr>
                                                            <tr>
                                                                <td>No. Rekening</td>
                                                                <td>:</td>
                                                                <td class="fw-bold">01234567689</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Atas Nama</td>
                                                                <td>:</td>
                                                                <td class="fw-bold">BukuKu</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Harga</td>
                                                                <td>:</td>
                                                                <td class="fw-bold"><?= format_rupiah($order['total']); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="buktiBayar" class="form-label">Unggah Bukti Pembayaran</label>
                                                        <input type="file" class="form-control" id="buktiBayar" name="bukti_bayar" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
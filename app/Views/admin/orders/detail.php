<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>
<!-- Page content-->
<div class="container-fluid">
    <h1 class="my-4"><?= $title; ?></h1>
    <div class="row">
        <?= $this->include('flashalert') ?>
        <div class="col-lg-12">
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

                        <a href="<?= base_url('admin/order/delete/' . $order['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Order</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
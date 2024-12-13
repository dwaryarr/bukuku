<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>
<!-- Page content-->
<div class="container-fluid">
    <h1 class="my-4"><?= $title; ?></h1>
    <div class="row">
        <?= $this->include('flashalert') ?>
        <div class="col-lg-12">
            <a href="/admin/product/add" class="btn btn-primary my-3"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatables" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Gambar Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                                <th>Status</th>
                                <th>Dibuat pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $p) : ?>
                                <tr>
                                    <td><img src="<?= base_url('assets/images/products/' . $p['image']) ?>" alt="<?= $p['name']; ?>" style="max-width: 100px;"></td>
                                    <td>
                                        <a href="/product/<?= $p['id'] ?>" class="fw-bold text-decoration-none"><?= $p['name']; ?></a><br><small class="text-muted"><?= $p['category']; ?></small>
                                    </td>
                                    <td><?= format_rupiah($p['price']); ?></td>
                                    <td><?= $p['discount'] > 0 ? $p['discount'] . '%' : '-'; ?></td>
                                    <td><?= $p['stock']; ?></td>
                                    <td><?= $p['sold']; ?></td>
                                    <td><?= $p['status'] == 'active' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>'; ?></td>
                                    <td><?= date('d F Y H:i:s', strtotime($p['created_at'])); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/product/edit/' . $p['id']); ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $p['id']; ?>"><i class="bi bi-trash"></i> Hapus</a>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?= $p['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $p['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $p['id']; ?>">Hapus Kategori</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus produk <span class="fw-bold">"<?= $p['name']; ?>"</span>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('admin/product/delete/' . $p['id']); ?>" class="btn btn-danger">Hapus</a>
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
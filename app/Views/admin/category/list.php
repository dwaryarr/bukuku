<?= $this->extend('admin/admin_layout') ?>
<?= $this->section('content') ?>
<!-- Page content-->
<div class="container-fluid">
    <h1 class="my-4"><?= $title; ?></h1>
    <div class="row">
        <?= $this->include('flashalert') ?>
        <div class="col-lg-12">
            <a href="#" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg"></i> Tambah Kategori</a>
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <form action="/admin/category/add" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category">Nama Kategori</label>
                                    <input type="text" class="form-control" id="category" name="category" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatables" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Dibuat pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $c) : ?>
                                <tr>
                                    <td><?= $c['category']; ?></td>
                                    <td><?= date('d F Y H:i:s', strtotime($c['created_at'])); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $c['id']; ?>"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <div class="modal fade" id="editModal<?= $c['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <form action="/admin/category/edit/<?= $c['id']; ?>" method="POST">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Tambah Kategori</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="category">Nama Kategori</label>
                                                                <input type="text" class="form-control" id="category" name="category" value="<?= $c['category']; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $c['id']; ?>"><i class="bi bi-trash"></i> Hapus</a>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?= $c['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $c['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $c['id']; ?>">Hapus Kategori</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus kategori produk <span class="fw-bold">"<?= $c['category']; ?>"</span>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('admin/user/delete/' . $c['id']); ?>" class="btn btn-danger">Hapus</a>
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
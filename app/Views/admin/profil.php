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
                    <div class="col-md-6">
                        <form action="<?= base_url('/profil'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="fullname">Nama Lengkap</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user['fullname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nohp">No HP</label>
                                <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $user['nohp']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" required><?= $user['alamat']; ?></textarea>
                            </div>
                            <a href="<?= base_url('/admin'); ?>" class="btn btn-warning mt-3">Kembali</a>
                            <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
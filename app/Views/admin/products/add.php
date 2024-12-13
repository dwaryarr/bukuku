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
                        <form action="<?= base_url('/admin/product/add'); ?>" method="post" enctype="multipart/form-data">
                            <div id="preview_image"></div>
                            <div class="form-group">
                                <label for="image">Gambar Produk</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= old('name'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga Produk (Rp)</label>
                                <input type="number" class="form-control" id="price" name="price" value="<?= old('price'); ?>" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="discount">Diskon (%)</label>
                                <input type="number" class="form-control" id="discount" name="discount" value="<?= old('discount'); ?>" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?= old('stock'); ?>" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Produk</label>
                                <textarea class="form-control" id="description" name="description" required><?= old('description'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Kategori Produk</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($categories as $c) :
                                        echo '<option value="' . $c['id'] . '" ' . (old('category_id') == $c['id'] ? 'selected' : '') . '>' . $c['category'] . '</option>';
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active" <?= old('status') == 'active' ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : ''; ?>>Tidak Aktif</option>
                                </select>
                            </div>
                            <a href="<?= base_url('admin/products'); ?>" class="btn btn-warning mt-3">Kembali</a>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        var preview = document.getElementById('preview_image');
        preview.innerHTML = '';
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.height = 'auto';
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<?= $this->endSection() ?>
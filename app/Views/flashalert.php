<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning">
        <?= session()->getFlashdata('warning') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('info')) : ?>
    <div class="alert alert-info">
        <?= session()->getFlashdata('info') ?>
    </div>
<?php endif; ?>
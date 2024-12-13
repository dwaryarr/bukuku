<?= $this->extend('auth/auth_layout') ?>
<?= $this->section('content') ?>
<div class="card bg-white p-4">
    <div class="card-body">
        <div class="text-center mb-4">
            <a href="/" class="h1 text-decoration-none">BukuKu</a>
            <h4 class="mt-2">Login</h4>
        </div>
        <?= $this->include('flashalert') ?>
        <form action="/login" method="POST">
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" placeholder="Enter your email" value="<?= old('email') ?>">
                <?php if (session('errors.email')) : ?>
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="password-container">
                    <input type="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" id="registerPassword" placeholder="Enter your password">
                    <span class="password-toggle" onclick="togglePassword('registerPassword', 'registerEye')">
                        <i class="bi bi-eye" id="registerEye"></i>
                    </span>
                    <?php if (session('errors.password')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>
        <div class="divider"></div>
        <p class="text-center mb-0">
            Don't have an account?
            <a href="/register" class="text-dark">Register</a>
        </p>
    </div>
</div>
<?= $this->endSection() ?>
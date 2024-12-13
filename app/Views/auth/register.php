<?= $this->extend('auth/auth_layout') ?>
<?= $this->section('content') ?>
<div class="card bg-white p-4">
    <div class="card-body">
        <div class="text-center mb-4">
            <a href="/" class="h1 text-decoration-none">BukuKu</a>
            <h4 class="mt-2">Register</h4>
        </div>
        <?= $this->include('flashalert') ?>
        <form action="/register" method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control <?= session('errors.fullname') ? 'is-invalid' : '' ?>" placeholder="Enter your full name" value="<?= old('fullname') ?>">
                <?php if (session('errors.fullname')) : ?>
                    <div class="invalid-feedback">
                        <?= session('errors.fullname') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="nohp" class="form-control <?= session('errors.nohp') ? 'is-invalid' : '' ?>" placeholder="Enter your phone number" value="<?= old('nohp') ?>">
                <?php if (session('errors.nohp')) : ?>
                    <div class="invalid-feedback">
                        <?= session('errors.nohp') ?>
                    </div>
                <?php endif; ?>
            </div>
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
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="password-container">
                    <input type="password" name="password_confirm" class="form-control <?= session('errors.password_confirm') ? 'is-invalid' : '' ?>" id="confirmPassword" placeholder="Confirm your password">
                    <span class="password-toggle" onclick="togglePassword('confirmPassword', 'confirmEye')">
                        <i class="bi bi-eye" id="confirmEye"></i>
                    </span>
                    <?php if (session('errors.password_confirm')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.password_confirm') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms">
                <label class="form-check-label" for="terms">
                    I agree to the Terms & Conditions
                </label>
            </div>
            <button type="submit" class="btn btn-dark w-100">Register</button>
        </form>
        <div class="divider"></div>
        <p class="text-center mb-0">
            Already have an account?
            <a href="/login" class="text-dark">Login</a>
        </p>
    </div>
</div>
<?= $this->endSection() ?>
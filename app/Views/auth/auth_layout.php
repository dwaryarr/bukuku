<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - BukuKu</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> -->

    <!-- Bootstrap icons-->
    <link href="<?= base_url('assets/css/bootstrap-icons-1.5.0/bootstrap-icons.css'); ?>" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .btn-dark {
            border-radius: 25px;
            padding: 10px 30px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #212529;
        }

        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-6 col-lg-4">

                <?= $this->renderSection('content') ?>
                <script>
                    function togglePassword(inputId, eyeId) {
                        const passwordInput = document.getElementById(inputId);
                        const eyeIcon = document.getElementById(eyeId);

                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            eyeIcon.classList.remove("bi-eye");
                            eyeIcon.classList.add("bi-eye-slash");
                        } else {
                            passwordInput.type = "password";
                            eyeIcon.classList.remove("bi-eye-slash");
                            eyeIcon.classList.add("bi-eye");
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</body>

</html>
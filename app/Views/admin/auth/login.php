<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sistema Imobiliário</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
    <style>
        body {
            background: linear-gradient(135deg, #0061f2 0%, #00ba94 100%);
            font-family: 'Inter', sans-serif;
        }
        .login-box {
            width: 400px;
            margin: 7% auto;
        }
        .login-logo {
            margin-bottom: 25px;
        }
        .login-logo b {
            color: #fff;
            font-size: 32px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .card-body {
            padding: 2rem;
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-group-text {
            border: none;
            background: #f8f9fa;
        }
        .form-control {
            border: 1px solid #e9ecef;
            padding: 0.75rem;
            height: auto;
        }
        .form-control:focus {
            border-color: #0061f2;
            box-shadow: 0 0 0 0.2rem rgba(0, 97, 242, 0.25);
        }
        .btn-primary {
            background: #0061f2;
            border: none;
            padding: 0.75rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: #0052cc;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Sistema</b> Imobiliário
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/login') ?>" method="post">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        ENTRAR NO SISTEMA
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

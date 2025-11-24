<?php
require_once("../config.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user'] = [
            'id'   => $user['id'],
            'name' => $user['name'],
            'email'=> $user['email'],
            'role' => $user['role']
        ];

        header("Location: ../index.php");
        exit;

    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Inventaris SMK Telkom Lampung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;

            /* BACKGROUND FIXED */
            background: url('../assets/img/back.png') no-repeat center center/cover;
            backdrop-filter: blur(3px);

            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            width: 420px;
            padding: 35px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.80);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            animation: fadeIn 0.6s ease-in-out;
            backdrop-filter: blur(5px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .btn-primary {
            background: #ff003c;
            border: none;
        }

        .btn-primary:hover {
            background: #d60032;
        }

        .forgot {
            font-size: 14px;
            opacity: .7;
        }
        .forgot:hover {
            opacity: 1;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h3 class="text-center mb-4 fw-bold text-danger">
        Aplikasi Inventaris<br>SMK Telkom Lampung
    </h3>

    <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" required class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" required class="form-control">
        </div>

        <button class="btn btn-primary w-100 py-2">Login</button>
    </form>

    <div class="text-center mt-3">
        <a class="forgot text-danger fw-bold text-decoration-none" href="reset_password.php">
            Lupa password?
        </a>
    </div>

</div>

</body>
</html>

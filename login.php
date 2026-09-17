<?php
require_once 'config.php';
if (is_logged_in()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id,name,email,role,password_hash FROM users WHERE email=? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        unset($user['password_hash']);
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Email atau password salah.';
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login - <?= e(APP_NAME) ?></title><link rel="stylesheet" href="assets/style.css">
</head>
<body class="login-page">
<div class="login-card">
    <div class="brand-mark">✝</div>
    <h1>PORTAL DIGITAL GEREJA</h1>
    <p class="muted">Pusat informasi dan pelayanan jemaat</p>
    <?php if ($error): ?><div class="alert danger"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Email</label><input type="email" name="email" required placeholder="nama@email.com">
        <label>Password</label><input type="password" name="password" required placeholder="••••••••">
        <button class="btn primary full">Masuk</button>
    </form>
    <div class="demo">Demo Admin: admin@gereja.local / admin123<br>Demo Jemaat: jemaat@gereja.local / jemaat123</div>
</div>
</body></html>

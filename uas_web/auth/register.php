<?php
include '../config/database.php';

$success = "";
$error = "";

if (isset($_POST['register'])) {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek email
    $cek = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $cek->execute([$email]);

    if ($cek->rowCount() > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO users (nama, email, password, role)
             VALUES (?,?,?,?)"
        );
        $stmt->execute([$nama, $email, $pass, 'user']); // ROLE USER

        $success = "Registrasi berhasil! Silakan login.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="auth-card">
    <h3 class="text-center mb-3">Register</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button name="register" class="btn btn-success w-100">
            Daftar
        </button>
    </form>
    <p class="text-center mt-3">
        Sudah punya akun?
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/database.php';



$jumlahProduk = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$jumlahUser   = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
$jumlahOrder  = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="sidebar">
    <div class="brand">Halaman Admin</div>
    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="produk.php">Produk</a>
    <a href="pesanan.php">Pesanan</a>
    <a href="profil.php">Profil Owner</a>
    <a href="../auth/logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
</div>
<div class="main-content">
    <h3 class="mb-4">Dashboard Admin</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-4 dashboard-card">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text fs-2"><?= $jumlahProduk ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-4 dashboard-card">
                <div class="card-body">
                    <h5 class="card-title">Total User</h5>
                    <p class="card-text fs-2"><?= $jumlahUser ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning mb-4 dashboard-card">
                <div class="card-body">
                    <h5 class="card-title">Total Pesanan</h5>
                    <p class="card-text fs-2"><?= $jumlahOrder ?></p>
                </div>
            </div>
        </div>
    </div>

    <a href="produk.php" class="btn btn-dark mt-3">Kelola Produk</a>
</div>

</body>
</html>

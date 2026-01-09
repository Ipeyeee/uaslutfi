<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/database.php';
$produk = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk</title>

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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Produk</h3>
        <a href="tambah_produk.php" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <div class="table-responsive table-custom">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach($produk as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['nama_produk'] ?></td>
                    <td>Rp <?= number_format($p['harga']) ?></td>
                    <td><?= $p['stok'] ?></td>
                    <td>
                        <a href="edit_produk.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-action">Edit</a>
                        <a href="hapus_produk.php?id=<?= $p['id'] ?>" 
                           class="btn btn-danger btn-action"
                           onclick="return confirm('Hapus produk ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

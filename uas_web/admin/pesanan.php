<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/database.php';

$data = $conn->query("
    SELECT 
        orders.id,
        orders.created_at,
        orders.status,
        orders.status_bayar,
        users.nama AS nama_user,
        SUM(order_items.qty * order_items.harga) AS total
    FROM orders
    JOIN users ON orders.user_id = users.id
    JOIN order_items ON orders.id = order_items.order_id
    GROUP BY orders.id
    ORDER BY orders.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="sidebar">
    <div class="brand">Admin Panel</div>
    <a href="dashboard.php">Dashboard</a>
    <a href="produk.php">Produk</a>
    <a href="pesanan.php" class="active">Pesanan</a>
    <a href="profil.php">Profil Owner</a>
    <a href="../auth/logout.php" onclick="return confirm('Logout?')">Logout</a>
</div>

<div class="main-content">
    <h3 class="mb-4">Manajemen Pesanan</h3>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pemesan</th>
                    <th>Total</th>
                    <th>Status Bayar</th>
                    <th>Status Pesanan</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach($data as $d): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama_user'] ?></td>
                    <td>Rp <?= number_format($d['total']) ?></td>
                    <td>
                        <span class="badge bg-<?= $d['status_bayar']=='SUDAH BAYAR'?'success':'secondary' ?>">
                            <?= $d['status_bayar'] ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-info"><?= $d['status'] ?></span>
                    </td>
                    <td>
                        <a href="pesanan_detail.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                        <a href="pesanan_hapus.php?id=<?= $d['id'] ?>"
                           onclick="return confirm('Hapus pesanan ini?')"
                           class="btn btn-sm btn-danger">
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

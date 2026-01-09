<?php
session_start();
include '../config/database.php';
include 'partials/navbar.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT 
        orders.id AS order_id,
        orders.status_bayar,
        orders.created_at,

        products.nama_produk,
        products.gambar,

        order_items.size,
        order_items.qty,
        order_items.harga

    FROM orders
    JOIN order_items ON orders.id = order_items.order_id
    JOIN products ON order_items.product_id = products.id
    WHERE orders.user_id = ?
    ORDER BY orders.created_at DESC
");
$stmt->execute([$user_id]);
$pesanan = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>
<div class="container mt-5 pt-5">
    <h3 class="mb-4">Pesanan Saya</h3>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Ukuran</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="240">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pesanan as $p): ?>
                <tr>
                    <td>
                        <img src="../upload/produk/<?= $p['gambar'] ?>" width="50">
                        <?= $p['nama_produk'] ?>
                    </td>
                    <td><?= $p['size'] ?></td>
                    <td><?= $p['qty'] ?></td>
                    <td>Rp <?= number_format($p['harga'] * $p['qty']) ?></td>
                    <td>
                        <span class="badge bg-<?= $p['status_bayar']=='SUDAH BAYAR'?'success':'secondary' ?>">
                            <?= $p['status_bayar'] ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($p['status_bayar']=='BELUM BAYAR'): ?>
                            <a href="bayar.php?id=<?= $p['order_id'] ?>" class="btn btn-sm btn-dark">Bayar</a>
                        <?php endif; ?>

                        <a href="invoice.php?id=<?= $p['order_id'] ?>" target="_blank"
                           class="btn btn-sm btn-outline-primary">
                           Cetak Struk
                        </a>

                        <a href="hapus_pesanan.php?id=<?= $p['order_id'] ?>"
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

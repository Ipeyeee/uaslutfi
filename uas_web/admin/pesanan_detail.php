<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/database.php';

$id = $_GET['id'];

$items = $conn->prepare("
    SELECT 
        products.nama_produk,
        order_items.qty,
        order_items.size,
        order_items.harga
    FROM order_items
    JOIN products ON order_items.product_id = products.id
    WHERE order_items.order_id=?
");
$items->execute([$id]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h4>Detail Pesanan</h4>

    <table class="table">
        <tr>
            <th>Produk</th>
            <th>Ukuran</th>
            <th>Qty</th>
            <th>Harga</th>
        </tr>
        <?php foreach($items as $i): ?>
        <tr>
            <td><?= $i['nama_produk'] ?></td>
            <td><?= $i['size'] ?></td>
            <td><?= $i['qty'] ?></td>
            <td>Rp <?= number_format($i['harga']) ?></td>
        </tr>
        <?php endforeach ?>
    </table>

    <form action="pesanan_status.php" method="post" class="mt-3">
        <input type="hidden" name="id" value="<?= $id ?>">
        <label>Status Pesanan</label>
        <select name="status" class="form-select mb-3">
            <option value="Pending">Pending</option>
            <option value="Diproses">Diproses</option>
            <option value="Selesai">Selesai</option>
        </select>
        <button class="btn btn-dark">Update Status</button>
        <a href="pesanan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>

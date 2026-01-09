<?php
include '../config/database.php';

$id = $_GET['id'];

$stmt = $conn->prepare("
    SELECT 
        orders.created_at,
        products.nama_produk,
        order_items.qty,
        order_items.harga,
        order_items.size
    FROM orders
    JOIN order_items ON orders.id = order_items.order_id
    JOIN products ON order_items.product_id = products.id
    WHERE orders.id=?
");
$stmt->execute([$id]);
$data = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: Arial; padding: 40px; }
        .box { border:1px solid #000; padding:20px; width:400px; }
    </style>
</head>
<body onload="window.print()">

<div class="box">
    <h3>INVOICE</h3>
    <hr>
    <p>Tanggal: <?= $data['created_at'] ?></p>
    <p>Produk: <?= $data['nama_produk'] ?></p>
    <p>Ukuran: <?= $data['size'] ?></p>
    <p>Qty: <?= $data['qty'] ?></p>
    <p>Harga: Rp <?= number_format($data['harga']) ?></p>
    <hr>
    <strong>Total: Rp <?= number_format($data['harga'] * $data['qty']) ?></strong>
</div>

</body>
</html>

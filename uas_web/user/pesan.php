<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (
    !isset($_POST['product_id']) ||
    !isset($_POST['size']) ||
    !isset($_POST['qty'])
) {
    header("Location: produk.php");
    exit;
}

$user_id   = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$size      = $_POST['size'];
$qty       = (int) $_POST['qty'];

if ($qty < 1) {
    $qty = 1;
}

$stmt = $conn->prepare("SELECT harga FROM products WHERE id=?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Produk tidak ditemukan";
    exit;
}

$harga = $product['harga'];
$total = $harga * $qty;

$conn->prepare("
    INSERT INTO orders (user_id, total)
    VALUES (?,?)
")->execute([$user_id, $total]);

$order_id = $conn->lastInsertId();

$conn->prepare("
    INSERT INTO order_items (order_id, product_id, size, qty, harga)
    VALUES (?,?,?,?,?)
")->execute([$order_id, $product_id, $size, $qty, $harga]);

header("Location: pesanan.php");
exit;

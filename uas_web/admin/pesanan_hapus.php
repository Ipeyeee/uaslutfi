<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak!");
}

if (!isset($_GET['id'])) {
    die("ID pesanan tidak ditemukan!");
}

$id = (int)$_GET['id'];

$check = $conn->prepare("SELECT id FROM orders WHERE id = ?");
$check->execute([$id]);

if (!$check->fetch()) {
    die("Pesanan tidak ditemukan!");
}

try {
    $conn->prepare("DELETE FROM order_items WHERE order_id = ?")->execute([$id]);
    
    $conn->prepare("DELETE FROM orders WHERE id = ?")->execute([$id]);
    
    $_SESSION['message'] = "Pesanan berhasil dihapus!";
    $_SESSION['message_type'] = "success";
    
} catch (Exception $e) {
    $_SESSION['message'] = "Gagal menghapus pesanan: " . $e->getMessage();
    $_SESSION['message_type'] = "danger";
}

header("Location: pesanan.php");
exit();
?>
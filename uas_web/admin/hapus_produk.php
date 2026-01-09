<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = $_GET['id'];

// Ambil data produk (untuk hapus gambar)
$stmt = $conn->prepare("SELECT gambar FROM products WHERE id = ?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if ($produk) {
    // Hapus file gambar jika ada
    $file = "../upload/produk/" . $produk['gambar'];
    if (file_exists($file)) {
        unlink($file);
    }

    // Hapus data produk
    $hapus = $conn->prepare("DELETE FROM products WHERE id = ?");
    $hapus->execute([$id]);
}

header("Location: produk.php");
exit;

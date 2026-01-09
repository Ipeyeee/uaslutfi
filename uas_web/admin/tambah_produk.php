<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/database.php';

if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    $desk  = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    // Nama file unik
    $namaFile = time() . "_" . $gambar;
    move_uploaded_file($tmp, "../upload/produk/" . $namaFile);

    $stmt = $conn->prepare(
        "INSERT INTO products (nama_produk, harga, stok, deskripsi, gambar)
         VALUES (?,?,?,?,?)"
    );
    $stmt->execute([$nama, $harga, $stok, $desk, $namaFile]);

    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="bg-form">

<div class="form-wrapper">
    <div class="card form-card">
        <div class="card-body p-4">

            <h4 class="mb-4 text-center fw-bold">Tambah Produk</h4>

            <form method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama" class="form-control form-control-lg" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control form-control-lg" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Gambar Produk</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="simpan" class="btn btn-primary btn-lg">
                        Simpan Produk
                    </button>
                    <a href="produk.php" class="btn btn-outline-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>

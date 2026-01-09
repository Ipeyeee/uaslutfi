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

// Ambil data lama
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if (!$produk) {
    header("Location: produk.php");
    exit;
}

// PROSES UPDATE
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    $desk  = $_POST['deskripsi'];

    // Cek apakah upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];

        $namaFile = time() . "_" . $gambar;
        move_uploaded_file($tmp, "../upload/produk/" . $namaFile);

        // Hapus gambar lama
        $fileLama = "../upload/produk/" . $produk['gambar'];
        if (file_exists($fileLama)) {
            unlink($fileLama);
        }
    } else {
        $namaFile = $produk['gambar'];
    }

    $update = $conn->prepare(
        "UPDATE products 
         SET nama_produk=?, harga=?, stok=?, deskripsi=?, gambar=? 
         WHERE id=?"
    );
    $update->execute([$nama, $harga, $stok, $desk, $namaFile, $id]);

    header("Location: produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="bg-form">

<div class="form-wrapper wide">
    <div class="card form-card">
        <div class="card-body p-5">
            <h3 class="mb-4 text-center fw-bold">Edit Produk</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama" class="form-control form-control-lg"
                               value="<?= htmlspecialchars($produk['nama_produk']) ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control form-control-lg"
                               value="<?= $produk['stok'] ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control form-control-lg"
                               value="<?= $produk['harga'] ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gambar Produk (Opsional)</label>
                        <input type="file" name="gambar" class="form-control form-control-lg">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($produk['deskripsi']) ?></textarea>
                </div>

                <div class="mb-4">
                    <small class="text-muted">Gambar saat ini:</small><br>
                    <img src="../upload/produk/<?= $produk['gambar'] ?>" width="120" class="rounded shadow-sm mt-2">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="produk.php" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" name="update" class="btn btn-primary px-5">
                        Update Produk
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>

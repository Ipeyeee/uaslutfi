<?php
session_start();
include '../config/database.php';
include 'partials/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$p = $stmt->fetch();

if (!$p) {
    echo "<h3 class='text-center mt-5'>Produk tidak ditemukan</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($p['nama_produk']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5 pt-5">
    <div class="row align-items-center">

        <div class="col-md-6">
            <img 
                src="../upload/produk/<?= htmlspecialchars($p['gambar']) ?>" 
                class="img-fluid rounded shadow"
                alt="<?= htmlspecialchars($p['nama_produk']) ?>"
            >
        </div>

        <div class="col-md-6">
            <h3 class="fw-bold"><?= htmlspecialchars($p['nama_produk']) ?></h3>
            <h5 class="text-muted mb-3">
                Rp <?= number_format($p['harga'],0,',','.') ?>
            </h5>

            <p><?= nl2br(htmlspecialchars($p['deskripsi'])) ?></p>

            <!-- FORM PESAN -->
            <form action="pesan.php" method="post">
                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">

                <label class="form-label">Pilih Ukuran</label>
                <select name="size" class="form-select mb-3" required>
                    <option value="">-- Pilih Ukuran --</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                    <option>XXL</option>
                </select>

                <label class="form-label">Jumlah</label>
                <input type="number" name="qty" min="1" value="1" class="form-control mb-3">

                <button type="submit" class="btn btn-dark w-100">
                    Pesan Sekarang
                </button>
            </form>
        </div>

    </div>
</div>

</body>
</html>

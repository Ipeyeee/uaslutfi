<?php
session_start();
include '../config/database.php';
include 'partials/navbar.php';

$produk = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>
<div class="container-fluid shop-wrapper">
    <div class="row">
        <!-- PRODUK -->
        <main class="col-md-10">
            <h3 class="fw-bold mb-4">Products</h3>

            <div class="row g-4">
                <?php foreach ($produk as $p): ?>
                <div class="col-md-3">
                    <a href="detail.php?id=<?= $p['id'] ?>" class="text-decoration-none">
                        <div class="product-card">
                            <img 
                                src="../upload/produk/<?= htmlspecialchars($p['gambar']) ?>" 
                                alt="<?= htmlspecialchars($p['nama_produk']) ?>"
                            >
                            <div class="product-info">
                                <h6><?= htmlspecialchars($p['nama_produk']) ?></h6>
                                <p>Rp <?= number_format($p['harga'],0,',','.') ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </main>

    </div>
</div>

</body>
</html>

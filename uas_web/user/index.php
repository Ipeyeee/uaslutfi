<?php
session_start();
include '../config/database.php';
include 'partials/navbar.php';

$produk = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Eternal Flowers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>

<!-- HERO SECTION -->
<section class="home-hero d-flex align-items-center">
    <div class="container text-center text-white">
        <h1 class="fw-bold display-4">Eternal Flowers</h1>
        <p class="lead mt-3">
             Dari Kelopak yang Mekar ke Pakaian yang Sempurna, 
             Kami Ciptakan Fashion yang Abadi, Berkualitas Tinggi,
            dan Selalu Segar untuk Jiwa yang Dinamis
        </p>
    </div>
</section>


<!-- PREVIEW PRODUK -->
<section class="home-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Produk Terbaru</h3>
            <a href="produk.php" class="text-decoration-none fw-semibold">
                Lihat Semua →
            </a>
        </div>

        <div class="row g-4">
            <?php foreach ($produk as $p): ?>
            <div class="col-md-3">
                <div class="product-card">
                    <img src="../upload/produk/<?= $p['gambar'] ?>" alt="<?= $p['nama_produk'] ?>">
                    <div class="product-info">
                        <h6><?= htmlspecialchars($p['nama_produk']) ?></h6>
                        <p>Rp <?= number_format($p['harga'],0,',','.') ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- PROFIL PERUSAHAAN -->
<section class="home-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold mb-3">Tentang Eternal Flowers</h3>
                <p>
                    <strong>Eternal Flowers</strong> adalah brand fashion yang bergerak di bidang apparel,
                     khususnya pakaian, dengan mengusung konsep Eternal Flowers.
                    E-FLOWS merepresentasikan keteguhan, loyalitas, dan proses bertumbuh yang tidak pernah berhenti, 
                    seperti bunga yang tetap mekar di kondisi apa pun. Melalui desain yang sederhana namun bermakna, .
                </p>
                <p>
                    E-FLOWS hadir sebagai identitas bagi mereka yang menjadikan pakaian bukan sekadar penampilan,
                    tetapi juga bentuk ekspresi diri dan semangat hidup
                </p>
                <a href="profilperusahaan.php" class="btn btn-dark mt-3">
                    Selengkapnya
                </a>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <video class="about-video-portrait"
                    autoplay
                    muted
                    loop
                    playsinline>
                    <source src="../assets/css/video/tentang-kami.mp4" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
            </div>
        </div>
    </div>
</section>

<footer class="home-footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4 ig-footer">
                <h5>Instagram</h5>
                <a href="https://instagram.com/eflows.store" target="_blank">
                    <img src="../assets/css/img/iglogo.jfif" alt="Instagram">
                </a>
            </div>

            <a href="faq.php">FAQ</a>

        </div>

        <hr class="footer-line">

        <p class="text-center small mb-0">
            © 2026 Eternal Flowers. All rights reserved.
        </p>
    </div>
</footer>

    <!-- Musik Latar Belakang -->
    <audio id="bgMusic" loop autoplay volume="0.3">
        <source src="../assets/css/audio/backsound.mp3" type="audio/mpeg">
        Browser Anda tidak mendukung pemutar audio.
    </audio>

    <!-- Tombol Kontrol Suara -->
    <div class="music-control" onclick="toggleMusic()">
        <i class="fas fa-volume-up" id="volumeIcon"></i>
    </div>

    <script>
        const music = document.getElementById('bgMusic');
        const icon = document.getElementById('volumeIcon');
        let isPlaying = true;

        function toggleMusic() {
            if (isPlaying) {
                music.pause();
                icon.classList.replace('fa-volume-up', 'fa-volume-mute');
            } else {
                music.play();
                icon.classList.replace('fa-volume-mute', 'fa-volume-up');
            }
            isPlaying = !isPlaying;
        }

        // Atribusi (disarankan ditampilkan di footer atau halaman tentang)
        console.log("Music: bensound.com - A Day To Remember");
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

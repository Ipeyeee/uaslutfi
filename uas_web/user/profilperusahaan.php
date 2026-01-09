<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Perusahaan | Eternal Flowers</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<div class="container company-bg-wrapper">

    <section class="company-bg-hero">

        <div class="company-bg-overlay"></div>

        <div class="company-bg-content text-center">
            <h1 class="company-bg-title">Eternal Flowers</h1>
            <p class="company-bg-tagline">
                Fashion Brand • Minimalist • Monochrome
<p> <strong>Eternal Flowers</strong> adalah brand fashion lokal yang berdiri sejak tahun 2025. Kami menghadirkan produk pakaian dengan konsep monokrom, minimalis, dan elegan yang ditujukan untuk generasi muda yang mengutamakan gaya sederhana namun berkarakter. </p> <p> Kami percaya bahwa desain yang sederhana mampu menciptakan kesan yang kuat serta meningkatkan rasa percaya diri penggunanya. </p> <p> Bunga edelweis sebagai logo Eternal Flowers melambangkan keabadian dan ketahanan yang selaras dengan tema bunga abadi—keberanian, kemurnian, dan cinta sejati dalam desain yang timeless. </p>
        </div>

    </section>

</div>


<footer class="home-footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4 ig-footer">
                <h5>Instagram</h5>
                <a href="https://instagram.com/eflows.store" target="_blank">
                    <img src="../assets/css/img/iglogo.jfif" alt="Instagram">
                </a>
            </div>

            <a href="faq.php" class="footer-faq-link">FAQ</a>
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

</body>
</html>

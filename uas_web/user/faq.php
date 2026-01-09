<?php include "partials/navbar.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>FAQ | Eternal Flowers</title>
    <link rel="stylesheet" href="../assets/css/user.css">
</head>
<body>

<div class="faq-page">
    <h1>Frequently Asked Questions</h1>

    <div class="faq-item">
        <button class="faq-question">Bagaimana cara melakukan pemesanan?</button>
        <div class="faq-answer">
            <p>Pemesanan dilakukan dengan memilih produk lalu melanjutkan ke proses pemesanan.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Apakah bisa custom bunga?</button>
        <div class="faq-answer">
            <p>Ya, kami menerima pesanan custom sesuai kebutuhan Anda.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Berapa lama proses pengerjaan?</button>
        <div class="faq-answer">
            <p>Proses pengerjaan memakan waktu sekitar 1–3 hari kerja.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Apakah melayani pengiriman?</button>
        <div class="faq-answer">
            <p>Kami melayani pengiriman sesuai area yang tersedia.</p>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
        item.parentElement.classList.toggle('active');
    });
});
</script>

</body>
</html>

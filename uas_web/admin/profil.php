<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="brand">Halaman Admin</div>
    <a href="dashboard.php">Dashboard</a>
    <a href="produk.php">Produk</a>
    <a href="pesanan.php">Pesanan</a>
    <a href="profil.php" class="active">Profil Owner</a>
    <a href="../auth/logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
</div>

<!-- CONTENT -->
<div class="admin-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">

                <div class="admin-profile">

                    <!-- HEADER -->
                    <div class="profile-header">
                        <img src="../assets/css/img/gambar2.jpeg" class="profile-photo">
                        <h4 class="mt-3 mb-1">Lutfi Ramdani</h4>
                        <small>Administrator Sistem</small>
                    </div>

                    <!-- BODY -->
                    <div class="profile-body">

                        <div class="profile-section">
                            <h6>Tentang Saya</h6>
                            <p>
                                Saya adalah administrator sistem yang bertanggung jawab
                                terhadap pengelolaan data, keamanan, serta stabilitas
                                aplikasi Eternal Flowers.
                            </p>
                        </div>

                        <div class="profile-section">
                            <h6>Biodata Mahasiswa</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="120">Nama</td>
                                    <td>: Muhamad Lutfi R</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>: 242511009</td>
                                </tr>
                                <tr>
                                    <td>Prodi</td>
                                    <td>: Bisnis Digital</td>
                                </tr>
                                <tr>
                                    <td>Fakultas</td>
                                    <td>: Ilmu Komputer</td>
                                </tr>
                            </table>
                        </div>

                        <div class="profile-section">
                            <h6>Kontak</h6>
                            <p class="mb-1">📧 lutfiramdani240@gmail.com</p>
                            <p class="mb-0">🌐 instagram.com/ltfi.r11</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>

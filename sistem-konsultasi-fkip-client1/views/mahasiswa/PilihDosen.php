<?php
session_start();
include '../../config/config.php';

// Ambil daftar dosen dari tabel `users` dengan role 'dosen'
$query = "SELECT id, nama_lengkap FROM users WHERE role = 'dosen'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Dosen untuk Konsultasi</title>
    <link rel="stylesheet" href="../../public/assets/css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="user-section">
            <a href="Profiles.php"><i class="fa-sharp fa-solid fa-user" style="color: white;"></i></a>
        </div>
        <div class="dash-tittle">
            <span>Konsultasi</span>
        </div>
        <div class="notification">
            <i class="fa fa-bell" aria-hidden="true"></i>
        </div>
        <a href="Dashboard.php"><button class="close-btn">✖</button></a>
    </div>

    <!-- Judul Halaman -->
    <div class="welcome-section">
        <h2 class="title">Pilih Dosen Pembimbing Akademik</h2>
    </div>

    <div class="content-section0">
        <div class="left-section1">
            <div class="span">
                <span><strong>PBI</strong></span>
            </div>
        </div>
    <!-- Daftar Dosen -->
    <div class="dosen-list">
        <?php while ($dosen = mysqli_fetch_assoc($result)) : ?>
            <div class="dosen-item">
                <img src="../../public/assets/img/pic1.jpg" alt="Profile" class="profile-pic">
                <p class="dosen-name"><?= $dosen['nama_lengkap']; ?></p>
                <p class="dosen-id">NIP: <?= $dosen['id']; ?></p>
                <a href="Konsultasi.php?dpa_id=<?= $dosen['id']; ?>" class="chat-button">Chat</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

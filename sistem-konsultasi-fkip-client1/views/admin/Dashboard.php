<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../views/auth/Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Dashboard Admin</title>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="user-section">
            <a href="../Profiles.php"><i class="fa-sharp fa-solid fa-user" style="color: white;"></i></a>
        </div>
        <div class="dash-tittle">
            <span>Home</span>
        </div>
        <div class="notification">
            <a href="../Notifikasi.php"><i class="fa fa-bell" aria-hidden="true"></i></a>
        </div>
        <a href="../../Index.php"><button class="close-btn">✖</button></a>
    </div>
    <!-- Dashboard Content -->
    <div class="welcome-section">
        <img src="Unsika.jpg" alt="UNSIKA" class="background-image">
        <h1>Selamat Datang Admin</h1>
    </div>
    <div class="feature-links">
                <a href="KelolaPengguna.php"><button>Kelola Pengguna</button></a>
                <a href="KelolaBeasiswa.php"><button>Kelola Beasiswa</button></a>
            </div>
    <a href="../../controllers/AuthController.php?action=logout">Logout</a>
</body>
</html>

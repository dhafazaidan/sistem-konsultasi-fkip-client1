<?php
session_start();
include '../config/config.php';
require_once '../controllers/AuthController.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$query = $conn->prepare("SELECT id, nama_lengkap, email, role FROM users WHERE id = ?");
$query->bind_param('s', $user_id); // Gunakan 's' untuk tipe string
$query->execute();
$result = $query->get_result();

// Cek apakah data ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

// Tutup statement
$query->close();
$conn->close();

if (isset($_POST['logout'])) {
    AuthController::logout();
    header("Location: ../Index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="user-section">
            <i class="fa fa-user-circle"></i>
            <span>Akun <?= ucfirst($user['role']); ?></span>
        </div>
        <div class="dash-tittle">
            <span>Profile</span>
        </div>
        <div class="notification">
            <i class="fa fa-bell"></i>
        </div>
        <a href="mahasiswa/Dashboard.php"><button class="close-btn">✖</button></a>
    </div>

    <!-- Profile Section -->
    <div class="profile-container">
        <div class="profile-card">
            <img src="../public/assets/img/pic1.jpg" alt="User Profile" class="profile-image">
            <h2><?= $user['nama_lengkap']; ?></h2>
            <p>Email: <?= $user['email']; ?></p>

            <?php if ($user['role'] === 'mahasiswa'): ?>
                <p>NPM: <?= $user['id']; ?></p>
                <p>Prodi: Pendidikan Matematika</p>
            <?php elseif ($user['role'] === 'dosen'): ?>
                <p>NIP: <?= $user['id']; ?></p>
                <p>Prodi: Dosen Pembimbing</p>
            <?php elseif ($user['role'] === 'admin'): ?>
                <p>NIP: <?= $user['id']; ?></p>
                <p>Administrator</p>
            <?php endif; ?>
        </div>
        <form method="POST" action="">
            <button type="submit" name="logout" class="logout-btn">⇦ Log out</button>
        </form>
    </div>
</body>
</html>

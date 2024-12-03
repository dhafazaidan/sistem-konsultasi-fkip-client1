<?php
session_start();
include '../../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Index.php?error=not_logged_in");
    exit();
}

$dosen_id = $_GET['dosen_id'] ?? null; 
if (!$dosen_id) {
    // Cari dosen pertama dengan role 'dosen' sebagai default
    $query = $conn->prepare("SELECT id, nama_lengkap FROM users WHERE role = 'dosen' LIMIT 1");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $dosen = $result->fetch_assoc();
        $dosen_id = $dosen['id'];
        $dosen_name = $dosen['nama_lengkap']; // Ambil nama dosen
    } else {
        // Jika tidak ada dosen yang tersedia
        echo "<script>alert('Tidak ada dosen yang tersedia.'); window.location.href='Dashboard.php';</script>";
        exit();
    }
    $query->close();
} else {
    // Jika dosen_id ditemukan di URL, ambil nama_lengkap dosen dari database
    $query = $conn->prepare("SELECT nama_lengkap FROM users WHERE id = ? AND role = 'dosen'");
    $query->bind_param("i", $dosen_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $dosen = $result->fetch_assoc();
        $dosen_name = $dosen['nama_lengkap']; // Ambil nama dosen
    } else {
        // Jika dosen_id tidak valid atau dosen tidak ditemukan
        echo "<script>alert('Dosen tidak ditemukan.'); window.location.href='Dashboard.php';</script>";
        exit();
    }
    $query->close();
}

$user_id = $_SESSION['user_id'];

// Ambil data nama pengguna
$query = $conn->prepare("SELECT nama_lengkap FROM users WHERE id = ?");
$query->bind_param("s", $user_id);
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nama_lengkap = $user['nama_lengkap'];
} else {
    echo "<script>alert('Data pengguna tidak ditemukan.'); window.location.href='Dashboard.php';</script>";
    exit();
}
$query->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO consultations (nama_lengkap, user_id, dosen_id, message, status, created_at) VALUES (?, ?, ?, ?, 'pending', NOW())");
    $stmt->bind_param("ssss", $nama_lengkap, $user_id, $dosen_id, $message);

    if ($stmt->execute()) {
        header("Location: Konsultasi.php?dosen_id=" . htmlspecialchars($dosen_id));
        exit();
    } else {
        echo "<script>alert('Gagal mengirim pesan. Silakan coba lagi.');</script>";
    }
    $stmt->close();
}

// Ambil pesan chat
$chatQuery = $conn->prepare("SELECT * FROM consultations WHERE (user_id = ? AND dosen_id = ?) ORDER BY created_at ASC");
$chatQuery->bind_param("ss", $user_id, $dosen_id);
$chatQuery->execute();
$chatResult = $chatQuery->get_result();
$chats = $chatResult->fetch_all(MYSQLI_ASSOC);
$chatQuery->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <title>Konsultasi</title>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="user-section">
            <a href="../Profiles.php"><i class="fa-sharp fa-solid fa-user" style="color: white;"></i></a>
        </div>
        <div class="dash-tittle">
            <span>Konsultasi</span>
        </div>
        <div class="notification">
            <i class="fa fa-bell" aria-hidden="true"></i>
        </div>
        <a href="Dashboard.php"><button class="close-btn">✖</button></a>
    </div>
    <div class="chat-container">
        <div class="chat-header">
            <div class="user-info">
                <img src="../../public/assets/img/pic1.jpg" alt="Profile" class="avatar">
                <div>
                    <strong><?= htmlspecialchars($dosen_name); ?></strong>
                    <p><span class="status-online"></span> Online</p>
                </div>
            </div>
            <div class="chat-actions">
                <i class="fa fa-bell"></i>
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="chat-body">
            <?php foreach ($chats as $chat): ?>
                <div class="message <?= $chat['user_id'] == $user_id ? 'user-message' : 'dpa-message'; ?>">
                    <?= htmlspecialchars($chat['message']); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST" class="chat-form">
            <input type="hidden" name="dosen_id" value="<?= htmlspecialchars($dosen_id); ?>">
            <textarea name="message" placeholder="Tulis pesan Anda..." required></textarea>
            <button type="submit"><i class="fa fa-paper-plane"></i></button>
        </form>
    </div>
</body>
</html>

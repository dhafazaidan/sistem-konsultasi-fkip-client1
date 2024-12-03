<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header('Location: /auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Query untuk mengambil data notifikasi
$stmt = $conn->prepare("
    SELECT replies.reply_text, 
           replies.created_at, 
           replies.status, 
           users.nama_lengkap AS nama_dosen 
    FROM replies
    JOIN consultations ON replies.consultation_id = consultations.consultations_id
    JOIN users ON replies.dosen_id = users.id
    WHERE consultations.user_id = ?
    ORDER BY replies.created_at DESC
");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Menyimpan hasil dalam array notifikasi
$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Notifikasi</title>
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
        <a href="mahasiswa\Dashboard.php"><button class="close-btn">✖</button></a>
    </div>
    <div class="notification-container">
        <div class="notification-header">
            <h2>Notifikasi</h2>
        </div>
        <?php if (empty($notifications)): ?>
            <p>Tidak ada notifikasi.</p>
        <?php else: ?>
            <?php foreach ($notifications as $notification): ?>
                <div class="notification-item">
                    <div>
                        <div class="sender-name">
                            <?php echo htmlspecialchars($notification['nama_dosen']); ?>
                        </div>
                        <div class="message">
                            <?php echo htmlspecialchars($notification['reply_text']); ?>
                        </div>
                    </div>
                    <div>
                        <div class="time">
                            <?php echo date("H:i", strtotime($notification['created_at'])); ?>
                        </div>
                        <?php if ($notification['status'] === 'unread'): ?>
                            <div class="unread-dot"></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>

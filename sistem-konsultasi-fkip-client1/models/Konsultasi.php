<?php
// Cek apakah session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Path absolut ke file config.php
include $_SERVER['DOCUMENT_ROOT'] . '/sistem-konsultasi-fkip-client1/config/config.php';

// Pastikan pengguna adalah dosen yang sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dosen') {
    header("Location: ../../public/Index.php?error=unauthorized");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $consultation_id = $_POST['consultation_id'];
    $reply_text = $_POST['balasan'];
    $dosen_id = $_SESSION['user_id'];

    if ($consultation_id && $reply_text) {
        // Masukkan balasan ke tabel replies
        $stmt = $conn->prepare("INSERT INTO replies (consultation_id, dosen_id, reply_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $consultation_id, $dosen_id, $reply_text);
        if ($stmt->execute()) {
            // Perbarui status konsultasi menjadi 'responded'
            $update_stmt = $conn->prepare("UPDATE consultations SET status = 'responded' WHERE id = ?");
            $update_stmt->bind_param("i", $consultation_id);
            $update_stmt->execute();
            $update_stmt->close();

            // Fetch the user_id (student) who created the consultation
            $user_stmt = $conn->prepare("SELECT user_id FROM consultations WHERE id = ?");
            $user_stmt->bind_param("i", $consultation_id);
            $user_stmt->execute();
            $user_stmt->bind_result($user_id);
            $user_stmt->fetch();
            $user_stmt->close();

            // Insert notification for the student
            $notification_text = "Dosen telah membalas konsultasi Anda.";
            $status = 'unread'; // Set the status as 'unread' for new notifications

            $notif_stmt = $conn->prepare("INSERT INTO notifications (user_id, message, status) VALUES (?, ?, ?)");
            $notif_stmt->bind_param("iss", $user_id, $notification_text, $status);
            $notif_stmt->execute();
            $notif_stmt->close();

            echo "<script>alert('Balasan berhasil dikirim.'); window.location.href='ResponKonsultasi.php';</script>";
        } else {
            echo "<script>alert('Gagal mengirim balasan.');</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom.');</script>";
    }
}
?>
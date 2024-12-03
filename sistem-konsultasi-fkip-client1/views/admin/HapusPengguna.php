<?php
// Mulai session jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../Index.php?error=unauthorized");
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . '/sistem-konsultasi-fkip-client1/config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pengguna berhasil dihapus!'); window.location.href='KelolaPengguna.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengguna.');</script>";
    }
}
?>

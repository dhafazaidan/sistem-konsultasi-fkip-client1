<?php
session_start();
include '../config/config.php';

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/Login.php");
    exit();
}

// Ambil role dari session
$role = $_SESSION['role'];

// Arahkan pengguna ke dashboard sesuai role
if ($role === 'mahasiswa') {
    header("Location: ../views/mahasiswa/Dashboard.php");
    exit();
} elseif ($role === 'dosen') {
    header("Location: ../views/dosen/Dashboard.php");
    exit();
} elseif ($role === 'admin') {
    header("Location: ../views/admin/Dashboard.php");
    exit();
} else {
    // Jika role tidak dikenali, redirect ke halaman login
    header("Location: ../views/auth/Login.php");
    exit();
}
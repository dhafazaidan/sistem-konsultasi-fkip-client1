<?php
// Konfigurasi Database
$host = "localhost";      // Server database, biasanya localhost
$dbname = "konseling";    // Nama database yang telah dibuat
$username = "root";       // Nama pengguna database (default untuk localhost biasanya "root")
$password = "";           // Password database (kosongkan jika tidak ada)

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Memeriksa apakah koneksi berhasil
// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// } else {
//     echo "Koneksi berhasil!";
// }
?>

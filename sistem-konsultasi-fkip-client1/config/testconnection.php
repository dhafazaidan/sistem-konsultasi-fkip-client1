<?php
include 'config.php'; // Mengimpor file koneksi database

// Menguji koneksi
if ($conn) {
    echo "Koneksi ke database berhasil!";
} else {
    echo "Koneksi gagal!";
}
?>

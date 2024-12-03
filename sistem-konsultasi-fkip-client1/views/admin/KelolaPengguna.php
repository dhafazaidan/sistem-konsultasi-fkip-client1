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
include '../../controllers/AuthController.php';

echo "<h2>Daftar Pengguna</h2>";

// Tampilkan daftar pengguna
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<h3>" . htmlspecialchars($row['nama_lengkap']) . " (" . htmlspecialchars($row['role']) . ")</h3>";
    echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
    echo "<a href='HapusPengguna.php?id=" . urlencode($row['id']) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\");'>Hapus</a>";
    echo "<hr>";
}

// Proses tambah pengguna baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null; // Enkripsi password
    $confirm_password = $_POST['confirm_password'] ?? null;
    $role = $_POST['role'] ?? 'mahasiswa';

    if ($nama_lengkap && $email && $password && $confirm_password && $role) {
        // Memanggil fungsi register dari AuthController
        $result = AuthController::register($nama_lengkap, $email, $password, $confirm_password, $role);

    if ($result) {
        echo "<script>alert('Pengguna baru berhasil ditambahkan!'); window.location.href='KelolaPengguna.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pengguna baru.');</script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form {
    max-width: 500px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
    background-repeat: no-repeat;
    background-position-x: 98%;
    background-position-y: 50%;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}
</style>
<body>
    <h2>Tambah Pengguna Baru</h2>
    <form method="POST" action="">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Konfirmasi Password:</label>
        <input type="password" name="confirm_password" required><br>

        <label>Role:</label>
        <select name="role" required>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit">Tambah Pengguna</button>
    </form>
</body>
</html>

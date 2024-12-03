<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'] . '/sistem-konsultasi-fkip-client1/config/config.php'; // Pastikan file ini untuk koneksi database sudah ada

class AuthController
{
    public static function login($email, $password)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['nama_lengkap'];

            // Redirect to dashboard
            header("Location: ../../public/Dashboard.php");
            exit();
        } else {
            // Redirect back to login page with error message
            header("Location: ../../Index.php?error=Invalid credentials");
            exit();
        }
    }

    public static function register($nama, $email, $password, $confirm_password, $role = 'mahasiswa')
    {
        global $conn;

        // Validasi konfirmasi password
        if ($password !== $confirm_password) {
            echo "<script>alert('Password dan Konfirmasi Password tidak sesuai.');</script>";
            return false;
        }

        // Periksa apakah email sudah terdaftar
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar. Silakan gunakan email lain.');</script>";
            return false;
        }

        // Mendapatkan ID terakhir berdasarkan role untuk penomoran otomatis
        $prefix = ($role === 'mahasiswa') ? '2' : '00';
        $query = "SELECT id FROM users WHERE id LIKE '$prefix%' ORDER BY id DESC LIMIT 1";
        $result = $conn->query($query);
        $lastId = $result->num_rows > 0 ? $result->fetch_assoc()['id'] : null;

        // Menentukan ID baru
        if ($role === 'mahasiswa') {
            $newId = $lastId ? (int)substr($lastId, 1) + 1 : 2000000000;
            $id = '2' . str_pad($newId, 10, '0', STR_PAD_LEFT);
        } else {
            $newId = $lastId ? (int)substr($lastId, 2) + 1 : 1;
            $id = '00' . str_pad($newId, 9, '0', STR_PAD_LEFT);
        }

        // Hashing password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Menyimpan data ke database
        $query = "INSERT INTO users (id, nama_lengkap, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $id, $nama, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            return true;
        } else {
            // Menampilkan pesan error jika penyimpanan gagal
            $error = $stmt->error;
            echo "<script>alert('Gagal mendaftarkan akun: $error');</script>";
            return false;
        }
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}
?>

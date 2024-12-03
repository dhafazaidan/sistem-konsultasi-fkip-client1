<?php
// Cek apakah session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Path absolut ke file config.php
include $_SERVER['DOCUMENT_ROOT'] . '/sistem-konsultasi-fkip-client1/config/config.php';

// Pastikan pengguna adalah dosen yang sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dosen') {
    header("Location: ../Index.php?error=unauthorized");
    exit();
}

$user_id = $_SESSION['user_id'];

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
    $consultation_id = $_POST['consultation_id'];
    $reply_text = $_POST['balasan'];
    $dosen_id = $_SESSION['user_id'];
    $nama_lengkap = $_SESSION['nama_lengkap']; // Pastikan Anda mendapatkan nama lengkap dari sesi atau input

    if ($consultation_id && $reply_text) {
        // Masukkan balasan ke tabel replies
        $stmt = $conn->prepare("INSERT INTO replies (consultation_id, nama_lengkap, dosen_id, reply_text, status) VALUES (?, ?, ?, ?, 'unread')");
        
        if ($stmt) {
            $stmt->bind_param("isss", $consultation_id, $nama_lengkap, $dosen_id, $reply_text);
            if ($stmt->execute()) {
                // Perbarui status konsultasi menjadi 'responded'
                $update_stmt = $conn->prepare("UPDATE consultations SET status = 'responded' WHERE consultations_id = ?");
                if ($update_stmt) {
                    $update_stmt->bind_param("i", $consultation_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                }

                echo "<script>alert('Balasan berhasil dikirim.'); window.location.href='ResponKonsultasi.php';</script>";
                echo "<script>
                    window.parent.postMessage('reloadPage', '*');
                </script>";
                exit();
            } else {
                echo "<script>alert('Gagal mengirim balasan.');</script>";
            }
            $stmt->close(); // Tutup pernyataan setelah selesai
        } else {
            echo "<script>alert('Gagal mempersiapkan pernyataan.');</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Balasan</title>

</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background-image: url('../../public/assets/img/unsika1.jpg');
    background-position: center;
}

.reply-container {
    background-color: rgba(255, 255, 255, 0.8);
    position: relative;
    border-radius: 10px;
    padding: 40px;
    width: 40%;
    max-width: 200px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    justify-content: center;
    color: #333;
    margin: 20px 0;
}

textarea {
    width: 80%;
    position: relative;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    resize: vertical;
    min-height: 100px;
    margin-bottom: 10px;
}

button {
    background-color: #d4af37;
    margin-left: 20px;
    right: 150px;
    top: 250px;
    position: absolute;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    float: right;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #c19b2e;
}

@media (max-width: 600px) {
    .reply-container {
        width: 95%;
    }
}

</style>
<body>
    <h2>Kirim Balasan Konsultasi</h2>
    <form method="POST" action="" class="message-form" id="replyForm">
        <input type="hidden" name="consultation_id" value="<?php echo $_GET['consultation_id']; ?>">
        <textarea name="balasan" placeholder="Tulis balasan di sini..." required></textarea>
        <button type="submit">Kirim Balasan</button>
    </form>

    <script>
    document.getElementById('replyForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            window.parent.postMessage('reloadPage', '*');
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
</body>
</html>
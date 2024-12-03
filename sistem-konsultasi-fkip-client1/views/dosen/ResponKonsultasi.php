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

// Mengambil daftar konsultasi yang membutuhkan balasan
$stmt = $conn->prepare("SELECT consultations.consultations_id AS id, 
                               consultations.message, 
                               consultations.created_at, 
                               users.nama_lengkap AS nama_mahasiswa, 
                               users.id AS npm 
                        FROM consultations 
                        JOIN users ON consultations.user_id = users.id
                        WHERE consultations.dosen_id = ? 
                        AND consultations.status = 'pending'
                        ORDER BY consultations.created_at DESC");

$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respon Konsultasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }
        
        .container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        .left-panel {
            flex: 0 0 300px;
            overflow-y: auto;
            border-right: 1px solid #ddd;
            padding: 20px;
            background: #f5f5f5;
        }

        .right-panel {
            flex: 1;
            overflow: hidden;
        }

        .consultation-item {
            padding: 15px;
            margin-bottom: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .consultation-item:hover {
            background-color: #e3f2fd;
        }

        .consultation-item h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .consultation-item p {
            font-size: 14px;
            margin: 5px 0;
            color: #666;
        }

        .chat-frame {
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left-panel {
                flex: 0 0 auto;
                max-height: 40vh;
            }

            .right-panel {
                flex: 1;
            }
        }
    </style>
</head>
<body>
        <!-- Header -->
    <div class="container">
                <a href="Dashboard.php"><button class="close-btn">✖</button></a>
        <div class="left-panel">
            <h2>Daftar Konsultasi</h2>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="consultation-item" onclick="loadChat(<?php echo $row['id']; ?>)">
                        <h3><?php echo htmlspecialchars($row['message']); ?></h3>
                        <p><strong>Mahasiswa:</strong> <?php echo htmlspecialchars($row['nama_mahasiswa']); ?></p>
                        <p><strong>NPM:</strong> <?php echo htmlspecialchars($row['npm']); ?></p>
                        <p><strong>Dibuat pada:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Tidak ada konsultasi yang membutuhkan balasan saat ini.</p>
            <?php endif; ?>
        </div>
        <div class="right-panel">
            <iframe id="chatFrame" class="chat-frame" src="about:blank"></iframe>
        </div>
    </div>

    <script>
        function loadChat(consultationId) {
            document.getElementById('chatFrame').src = `KirimBalasan.php?consultation_id=${consultationId}`;
            
            if (window.innerWidth <= 768) {
                document.querySelector('.right-panel').scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Add message listener
        window.addEventListener('message', function(event) {
            if (event.data === 'reloadPage') {
                window.location.reload();
            }
        });

        // Load first chat automatically if exists
        <?php if ($result->num_rows > 0): ?>
        window.onload = function() {
            loadChat(<?php echo $result->data_seek(0) && $result->fetch_assoc()['id']; ?>);
        }
        <?php endif; ?>
    </script>
</body>
</html>

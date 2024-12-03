<?php
session_start();
if ($_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../../views/auth/Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="user-section">
            <a href="../Profiles.php"><i class="fa-sharp fa-solid fa-user" style="color: white;"></i></a>
        </div>
        <div class="dash-tittle">
            <span>Home</span>
        </div>
        <div class="notification">
            <a href="../Notifikasi.php"><i class="fa fa-bell" aria-hidden="true"></i></a>
        </div>
        <a href="../../Index.php"><button class="close-btn">✖</button></a>
    </div>

    <!-- Background Image with Welcome Text -->
    <div class="welcome-section">
        <img src="Unsika.jpg" alt="UNSIKA" class="background-image">
        <h1>Selamat Datang Mahasiswa</h1>
    </div>

    <!-- Consultation and Scholarship Information -->
    <div class="content-section">
        <div class="left-section">
            <h2 class="kons">Konsultasi</h2>
            <div class="buttons-group">
                <a href="PilihDosen.php"><button>PBI</button></a>
                <a href="PilihDosen.php"><button>PJKR</button></a>
                <a href="PilihDosen.php"><button>PMTIK</button></a>
                <a href="PilihDosen.php"><button>PENMAS</button></a>
                <a href="PilihDosen.php"><button>PBSI</button></a>
            </div>
        </div>

        <div class="right-section">
            <h2 class="kons">Informasi Beasiswa</h2>
            <div class="buttons-group">
                <a href=Beasiswa.php><button>Akademik</button></a>
                <a href=Beasiswa.php><button>Non Akademik</button></a>
            </div>
        </div>
    </div>
</body>
</html>

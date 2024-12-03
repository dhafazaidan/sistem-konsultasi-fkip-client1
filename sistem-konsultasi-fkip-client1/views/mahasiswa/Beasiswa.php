<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/sistem-konsultasi-fkip-client1/config/config.php';

// Fetch data from database
$query = "SELECT * FROM scholarships";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Beasiswa</title>
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
            <span>Beasiswa</span>
        </div>
        <div class="notification">
            <a href="../Notifikasi.php"><i class="fa fa-bell" aria-hidden="true"></i></a>
        </div>
        <a href="../../Index.php"><button class="close-btn">✖</button></a>
    </div>

    <div class="welcome-section">
        <h1 class="beas">Daftar Beasiswa</h1>
</div>

    <main class="scholarship-container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="scholarship-card">
                <h3 class="scholarship-title"><?= htmlspecialchars($row['judul']) ?></h3>
                <img src="<?= htmlspecialchars($row['poster_url']) ?>" alt="Poster Beasiswa" class="scholarship-image">
                <p class="scholarship-description"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
                <p class="scholarship-type"><?= htmlspecialchars($row['Tipe']) ?></p>
            </div>
        <?php endwhile; ?>
    </main>
</body>
</html>

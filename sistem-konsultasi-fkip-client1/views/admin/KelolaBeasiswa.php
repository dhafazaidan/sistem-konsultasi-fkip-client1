<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'] . '/sistem-konsultasi-fkip-client1/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $poster_url = $_POST['poster_url'];
    $tipe = $_POST['tipe'];

    $query = "INSERT INTO scholarships (judul, deskripsi, poster_url, tipe) VALUES ('$judul', '$deskripsi', '$poster_url', '$tipe')";
    mysqli_query($conn, $query);
    echo "Beasiswa berhasil ditambahkan!";
}

echo "<h2>Kelola Beasiswa</h2>";
?>

<style>
    form {
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

form &gt; * {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
textarea,
select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

textarea {
    height: 100px;
    resize: vertical;
}

select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,');
    background-repeat: no-repeat;
    background-position-x: 98%;
    background-position-y: 50%;
    background-color: white;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* Responsive design */
@media (max-width: 600px) {
    form {
        width: 90%;
        margin: 10px auto;
    }
}

</style>
<form method="POST" action="">
    Judul: <input type="text" name="judul" required><br>
    Deskripsi: <textarea name="deskripsi" required></textarea><br>
    Poster URL: <input type="text" name="poster_url" required><br>
    Tipe Beasiswa: <select name="tipe" required>
        <option value="akademik">Akademik</option>
        <option value="non-akademik">Non-Akademik</option>
        </select>
    <button type="submit">Tambah Beasiswa</button>
</form>

<?php
include '../../controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AuthController::login($_POST['email'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title></title>
    <style>
        body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        background-image: url("Unsika1.jpg");
    background-size: cover; /* Menyesuaikan gambar dengan ukuran layar */
    background-position: center; /* Memusatkan gambar */
    height: 100vh;
        }
    .container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
    position: absolute;
    top: 50%; /* Pindahkan ke tengah vertikal */
    left: 50%; /* Pindahkan ke tengah horizontal */
    transform: translate(-50%, -50%); /* Sesuaikan posisi untuk benar-benar berada di tengah */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
    margin: 0;
    color: #333;
}
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}
button {
    width: 100%;
    padding: 10px;
    background-color: #c0a258;
    border: none;
    color: white;
    border-radius: 4px;
    cursor: pointer;
}
select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
</div>
    </script>
</body>
</html>
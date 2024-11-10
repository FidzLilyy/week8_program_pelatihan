<?php
session_start();
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    $stmt = $pdo->prepare("INSERT INTO berita (judul, konten) VALUES (?, ?)");
    $stmt->execute([$judul, $konten]);

    header("Location: ../kelola_berita.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Berita</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 500px; margin: 0 auto; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        input[type="text"], textarea { width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #007bff; color: white; border: none; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Tambah Berita</h1>
    <form action="tambah_berita.php" method="POST">
        <label>Judul:</label>
        <input type="text" name="judul" required>
        
        <label>Konten:</label>
        <textarea name="konten" rows="5" required></textarea>
        
        <button type="submit">Tambah Berita</button>
    </form>
</body>
</html>

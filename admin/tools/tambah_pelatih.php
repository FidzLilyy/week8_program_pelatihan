<?php
session_start();
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $melatih = $_POST['melatih'];

    $stmt = $pdo->prepare("INSERT INTO pelatih (nama, email, melatih) VALUES (?, ?, ?)");
    $stmt->execute([$nama, $email, $melatih]);

    header("Location: ../kelola_pelatih.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Pelatih</title>
    <style>
        /* Reset beberapa gaya default */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Gaya umum untuk body */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #333;
    padding: 20px;
}

/* Judul halaman */
h1 {
    font-size: 28px;
    color: #343a40;
    margin-bottom: 20px;
    text-align: center;
}

/* Form container */
form {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 0 auto;
}

/* Label */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
}

/* Input fields and select box */
/* Gaya umum untuk input */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box;
}

/* Fokus pada input saat diklik */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="number"]:focus,
select:focus {
    border-color: #007bff;
    outline: none;
}

/* Gaya khusus untuk input nomor telepon */
input[type="tel"] {
    background-color: #f9f9f9;
    font-family: monospace; /* Memperjelas input angka */
}

/* Menambahkan icon atau placeholder */
input[type="tel"]::placeholder {
    color: #888;
    font-style: italic;
}

/* Menambahkan margin bottom untuk setiap input */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="number"],
select {
    margin-bottom: 15px;
}

/* Mengatur tombol submit */
button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect pada tombol */
button:hover {
    background-color: #0056b3;
}

/* Gaya untuk tombol kembali */
.btn-back {
    display: inline-block; /* Membuat <a> berperilaku seperti tombol */
    padding: 12px 20px;
    background-color: #6c757d; /* Warna latar belakang abu-abu */
    color: white;
    font-size: 16px;
    text-align: center;
    text-decoration: none; /* Menghilangkan garis bawah dari link */
    border-radius: 4px; /* Sudut membulat */
    transition: background-color 0.3s ease;
    margin-top: 10px; /* Menambahkan jarak atas jika diperlukan */
}

/* Hover effect pada tombol */
.btn-back:hover {
    background-color: #5a6268; /* Warna latar belakang berubah saat hover */
}

/* Fokus pada tombol */
.btn-back:focus {
    outline: none; /* Menghilangkan outline saat fokus */
    border: 2px solid #007bff; /* Garis biru saat fokus */
}

    </style>
</head>
<body>
    <h1>Tambah Data Peserta</h1>
    <form action="tambah_pelatih.php" method="POST">
        <label>Nama:</label>
            <input type="text" name="nama" required><br>
        <label>Email:</label>
            <input type="email" name="email" required><br>
        <label>Melatih:</label>
            <input type="text" name="melatih" required><br>
        <button type="submit">Tambah</button><br><br>
        <a href="../kelola_pelatih.php" class="btn-back">Kembali</a>
    </form>
</body>
</html>

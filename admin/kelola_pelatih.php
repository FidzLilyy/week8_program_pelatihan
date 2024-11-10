<?php
session_start();
include '../config/config.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Anda harus login sebagai admin untuk mengakses halaman ini.');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Ambil data peserta dari database
$stmt = $pdo->prepare("SELECT * FROM pelatih");
$stmt->execute();
$pelatih = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Pelatih</title>
    <style>
        /* Reset beberapa gaya default */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Pengaturan font untuk seluruh halaman */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    padding: 20px;
}

/* Judul halaman */
h1 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
}

/* Link untuk menambah peserta */
a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
    padding: 8px 16px;
    margin-bottom: 20px;
    display: inline-block;
    border: 2px solid #007BFF;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

a:hover {
    background-color: #007BFF;
    color: white;
}

/* Tabel data peserta */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #007BFF;
    color: white;
}

td {
    background-color: #fff;
}

/* Tombol aksi Edit & Hapus */
a[href*='edit'], a[href*='hapus'] {
    color: #007BFF;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 4px;
    margin-right: 5px;
}

a[href*='edit']:hover, a[href*='hapus']:hover {
    background-color: #007BFF;
    color: white;
}

/* Mengatur gaya untuk konfirmasi tombol */
a[href*='hapus'] {
    background-color: #FF6B6B;
    border: 1px solid #FF6B6B;
}

a[href*='hapus']:hover {
    background-color: #FF4C4C;
}

/* Responsif untuk tampilan perangkat kecil */
@media (max-width: 768px) {
    table, th, td {
        font-size: 14px;
    }

    a {
        font-size: 16px;
        padding: 6px 12px;
    }

    h1 {
        font-size: 24px;
    }
}

    </style>
</head>
<body>
    <h1>Kelola Data Pelatih</h1>

    <a href="dashboard.php">Kembali</a>
    <a href="tools/tambah_pelatih.php">Tambah Pelatih</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($pelatih as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['email'] ?></td>
                <td><?= $p['melatih'] ?></td>
                <td>
                    <a href="tools/edit_pelatih.php?id=<?= $p['id'] ?>">Edit</a> |
                    <a href="tools/delete_pelatih.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

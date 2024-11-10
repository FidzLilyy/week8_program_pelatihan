<?php
session_start();
include '../../config/config.php';

if (!isset($_GET['id'])) {
    header("Location: ../kelola_peserta.php");
    exit();
}
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM peserta WHERE id = ?");
$stmt->execute([$id]);
$peserta = $stmt->fetch();

if (!$peserta) {
    header("Location: ../kelola_peserta.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jk = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    $stmt = $pdo->prepare("UPDATE peserta SET nama = ?, email = ?, jk = ?, alamat = ?, telp = ? WHERE id = ?");
    $stmt->execute([$nama, $email, $jk, $alamat, $telp, $id]);

    header("Location: ../kelola_peserta.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Peserta</title>
    <style>
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
    <h1>Edit Data Peserta</h1>
    <form action="edit_peserta.php?id=<?php echo $id; ?>" method="POST">
        <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($peserta['nama']); ?>" required><br>
        <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($peserta['email']); ?>" required><br>
        <label>Pilih Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="Laki-Laki" <?php if ($peserta['jk'] == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
            <option value="Perempuan" <?php if ($peserta['jk'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
        </select>
        <label>Alamat:</label>
            <input type="text" name="alamat" value="<?php echo htmlspecialchars($peserta['alamat']); ?>" required><br>
        <label>No Telepon:</label>
            <input type="tel" name="telp" pattern="\+?[0-9]{1,4}?[-. ]?(\(?\d{1,3}?\))?[-. ]?\d{1,4}[-. ]?\d{1,4}[-. ]?\d{1,9}" value="<?php echo htmlspecialchars($peserta['telp']); ?>" required><br>
        <button type="submit">Simpan Perubahan</button><br><br>
        <a href="../kelola_peserta.php" class="btn-back">Kembali</a>
    </form>
</body>
</html>

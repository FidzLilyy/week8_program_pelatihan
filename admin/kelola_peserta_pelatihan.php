<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>
        alert('Anda harus login sebagai admin untuk mengakses halaman ini.');
        window.location.href = '../login.php';
    </script>";
    exit();
}

// Query untuk mengambil data peserta dan program yang mereka pilih
$query = "SELECT peserta.nama AS nama_peserta, program_pelatihan.judul, peserta_program.id
          FROM peserta_program
          JOIN peserta ON peserta_program.peserta_id = peserta.id
          JOIN program_pelatihan ON peserta_program.id_program = program_pelatihan.id
          ORDER BY peserta.nama";

$stmt = $pdo->query($query);
$pesertaPrograms = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Peserta Program</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7fa;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

h1 {
    font-size: 28px;
    color: #007bff;
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
}

.program-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.program-card {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 8px;
    width: 280px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.program-card h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
    text-align: center;
}

.program-card p {
    font-size: 14px;
    color: #555;
    margin-bottom: 20px;
    text-align: center;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.delete-btn:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .program-container {
        flex-direction: column;
        align-items: center;
    }

    .program-card {
        width: 100%;
        max-width: 350px;
        margin-bottom: 20px;
    }
}

.back-btn {
    display: inline-block;
    background-color: #007bff; /* Warna biru */
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    transition: background-color 0.3s;
}

.back-btn:hover {
    background-color: #0056b3; /* Warna biru yang lebih gelap saat hover */
}
    </style>
</head>
<body>
    <h1>Kelola Peserta Program Pelatihan</h1>
    <a href="dashboard.php" class="back-btn">Kembali</a>
    <div class="program-container">

        <?php foreach ($pesertaPrograms as $program): ?>
            <div class="program-card">
                <h2>Nama Peserta: <?= htmlspecialchars($program['nama_peserta']) ?></h2>
                <p>Program Yang Diikuti: <br> <?= htmlspecialchars($program['judul']) ?></p>
                <form method="POST" action="tools/delete_peserta_program.php">
                    <input type="hidden" name="id" value="<?= $program['id'] ?>">
                    <button type="submit" class="delete-btn">Hapus</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

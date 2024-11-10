<?php
session_start();
include '../config/config.php';

// Ambil semua data berita dari database
$stmt = $pdo->query("SELECT * FROM berita");
$beritaList = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Berita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .berita-box {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .berita-box h2 {
            margin-top: 0;
            color: #007bff;
        }
        .berita-box p {
            color: #555;
        }
        .actions {
            margin-top: 10px;
        }
        .actions a {
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            margin-right: 5px;
        }
        .actions .edit-btn {
            background-color: #28a745;
        }
        .actions .delete-btn {
            background-color: #dc3545;
        }
        .add-btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-align: center;
            border-radius: 4px;
            margin-bottom: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kelola Berita</h1>
        <a href="dashboard.php" class="add-btn">Kembali</a>
        <a href="tools/tambah_berita.php" class="add-btn">Tambah Berita</a>

        <?php foreach ($beritaList as $berita): ?>
            <div class="berita-box">
                <h2><?php echo htmlspecialchars($berita['judul']); ?></h2>
                <p><?php echo htmlspecialchars($berita['konten']); ?></p>
                <div class="actions">
                    <a href="tools/edit_berita.php?id=<?php echo $berita['id']; ?>" class="edit-btn">Edit</a>
                    <a href="tools/delete_berita.php?id=<?php echo $berita['id']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

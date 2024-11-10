<?php
session_start();
include '../../config/config.php';

if (!isset($_GET['id'])) {
    header("Location: ../kelola_berita.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM berita WHERE id = ?");
$stmt->execute([$id]);
$berita = $stmt->fetch();

if (!$berita) {
    header("Location: ../kelola_berita.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    $stmt = $pdo->prepare("UPDATE berita SET judul = ?, konten = ? WHERE id = ?");
    $stmt->execute([$judul, $konten, $id]);

    header("Location: ../kelola_berita.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 500px; margin: 0 auto; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        input[type="text"], textarea { width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 20px; background-color: #28a745; color: white; border: none; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h1>Edit Berita</h1>
    <form action="edit_berita.php?id=<?php echo $id; ?>" method="POST">
        <label>Judul:</label>
        <input type="text" name="judul" value="<?php echo htmlspecialchars($berita['judul']); ?>" required>
        
        <label>Konten:</label>
        <textarea name="konten" rows="5" required><?php echo htmlspecialchars($berita['konten']); ?></textarea>
        
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>

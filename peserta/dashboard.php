<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['peserta_id'])) {
    header("Location: login.php");
    exit();
}

$peserta_id = $_SESSION['peserta_id'];

$stmt = $pdo->query("SELECT * FROM program_pelatihan");
$programList = $stmt->fetchAll();

$username = $_SESSION['username'];

$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pilih Program Pelatihan</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7fa;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
    color: #4e73df;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.program-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin: 20px 0;
}

.program-card {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 12px;
    width: 250px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.program-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.program-card h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 12px;
    text-align: center;
    font-weight: bold;
}

.program-card p {
    font-size: 14px;
    color: #777;
    margin-bottom: 15px;
    text-align: justify;
    line-height: 1.5;
}

.choose-btn {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.3s ease;
    width: 100%;
    margin-top: 10px;
}

.choose-btn:hover {
    background-color: #218838;
    transform: scale(1.05);
}

.choose-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
}

.logout-btn {
    display: inline-block;
    text-align: center;
    margin-top: 30px;
    font-size: 16px;
    color: #333;
    text-decoration: none;
    border: 1px solid #ddd;
    padding: 10px 20px;
    border-radius: 30px;
    background-color: #fff;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.logout-btn:hover {
    background-color: #e2e6ea;
    color: #007bff;
}

.logout-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
}

    </style>
</head>
<body>
    <h1>Pilih Program Pelatihan</h1>
    <h1>Hallo, <?php echo htmlspecialchars($user['username']) ?></h1>
    <div class="program-container">
        <?php foreach ($programList as $program): ?>
            <div class="program-card">
                <h2><?= htmlspecialchars($program['judul']) ?></h2>
                <p>Deskripsi: <?= htmlspecialchars($program['konten']) ?></p>
                <form method="POST" action="pilih_program.php">
                    <input type="hidden" name="id_program" value="<?= $program['id'] ?>">
                    <button type="submit" class="choose-btn">Pilih Program</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="../logout.php" class="logout-btn">Logout</a>
</body>
</html>

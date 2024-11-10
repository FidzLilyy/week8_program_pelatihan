<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'peserta' || !isset($_POST['id_program'])) {
    echo "<script>
        alert('Akses tidak valid.');
        window.location.href = 'dashboard_peserta.php';
    </script>";
    exit();
}

$id_program = $_POST['id_program'];
$peserta_id = $_SESSION['peserta_id'];

$checkQuery = "SELECT * FROM peserta_program WHERE peserta_id = ? AND id_program = ?";
$checkStmt = $pdo->prepare($checkQuery);
$checkStmt->execute([$peserta_id, $id_program]);

if ($checkStmt->rowCount() == 0) {
    $stmt = $pdo->prepare("INSERT INTO peserta_program (peserta_id, id_program) VALUES (?, ?)");
    $stmt->execute([$peserta_id, $id_program]);
    echo "<script>
        alert('Program berhasil dipilih!');
        window.location.href = 'dashboard.php';
    </script>";
} else {
    echo "<script>
        alert('Anda sudah memilih program ini.');
        window.location.href = 'dashboard.php';
    </script>";
}
?>

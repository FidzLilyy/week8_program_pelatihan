<?php
session_start();
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM peserta_program WHERE id = ?");
    $stmt->execute([$id]);

    echo "<script>
        alert('Data berhasil dihapus.');
        window.location.href = '../kelola_peserta_pelatihan.php';
    </script>";
    exit();
} else {
    echo "Akses tidak valid.";
}
?>

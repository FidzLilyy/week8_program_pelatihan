<?php
session_start();
include '../../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM berita WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: ../kelola_berita.php");
exit();
?>

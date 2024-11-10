<?php
session_start();
include '../../config/config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM pelatih WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../kelola_pelatih.php");
exit();
?>
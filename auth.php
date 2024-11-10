<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>
    alert('Anda harus login untuk mengakses halaman ini.');
    window.location.href = '../login.php';
  </script>";
    exit();
}

function checkRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}
?>

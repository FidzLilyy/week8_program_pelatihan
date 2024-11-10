<?php
include '../auth.php';
include '../config/config.php';

if (!checkRole('admin')) {
    echo "<script>
    alert('Anda harus login sebagai admin untuk mengakses halaman ini.');
    window.location.href = '../login.php';
  </script>";
    exit();
}
$username = $_SESSION['username'];

$stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Kelola Data</title>
    <style>
/* Reset beberapa style default */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Umum dan Body */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7fa;
    color: #333;
    line-height: 1.6;
}

h1 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
    font-weight: 600;
}

/* Navbar Styling */
nav {
    background-color: #007bff;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

nav ul {
    list-style-type: none;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 15px;
    border-radius: 30px;
    transition: all 0.3s ease;
}

nav ul li a:hover,
nav ul li a:focus {
    background-color: #0056b3;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
    transform: scale(1.05);
}

/* Styling untuk welcome message */
h1.welcome-message {
    font-size: 22px;
    color: #007bff;
    text-align: center;
    margin-top: 20px;
}

h1.welcome-message span {
    color: #28a745;
    font-weight: bold;
}

/* Main Content Styling */
main {
    padding: 30px;
    max-width: 1100px;
    margin: 0 auto;
}

/* Box shadow untuk content area */
section {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Daftar menu / link di navbar */
ul li a {
    display: block;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

/* Styling untuk logout button */
a.logout-btn {
    display: inline-block;
    background-color: #d9534f;
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    text-decoration: none;
    margin-top: 30px;
    font-size: 16px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, transform 0.2s ease;
}

a.logout-btn:hover {
    background-color: #c9302c;
    transform: scale(1.05);
}

a.logout-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.4);
}

/* Responsivitas */
@media (max-width: 768px) {
    nav ul {
        flex-direction: column;
        padding: 0;
        text-align: center;
    }

    nav ul li {
        margin-bottom: 10px;
    }

    main {
        padding: 15px;
    }

    .logout-btn {
        width: 100%;
        text-align: center;
        padding: 12px 0;
    }
}
    </style>
</head>
<body>
    <h1 class="welcome-message">Dashboard Admin</h1>
    <h1 class="welcome-message">Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    <nav>
        <ul>
            <li><a href="kelola_peserta.php">Data Peserta</a></li>
            <li><a href="kelola_pelatih.php">Data Tenaga Pelatih</a></li>
            <li><a href="kelola_peserta_pelatihan.php">Data Program Pelatihan</a></li>
            <li><a href="kelola_berita.php">Data Berita</a></li>
        </ul>
    </nav>
    <a href="../logout.php" class="logout-btn">Logout</a>
</body>
</html>
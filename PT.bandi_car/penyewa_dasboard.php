<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penyewa - PT Bandi Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #DCDCDC;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .mobil-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .mobil-card {
            background-color: white;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include 'koneksi.php';

    // Pastikan hanya penyewa yang bisa akses
    if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'penyewa') {
        header("Location: login.php");
        exit();
    }

    // Ambil data mobil tersedia
    $query = "SELECT * FROM mobil WHERE status='tersedia'";
    $result = mysqli_query($koneksi, $query);
    ?>
    <div class="container">
        <h1>Selamat Datang, Penyewa</h1>
        <h2>Mobil Tersedia</h2>
        <div class="mobil-grid">
            <?php while($mobil = mysqli_fetch_assoc($result)) { ?>
                <div class="mobil-card">
                    <h3><?php echo $mobil['merk'] . ' ' . $mobil['model']; ?></h3>
                    <p>Tahun: <?php echo $mobil['tahun']; ?></p>
                    <p>Harga: Rp <?php echo number_format($mobil['harga_sewa'], 0, ',', '.'); ?>/hari</p>
                    <a href="sewa_mobil.php?id=<?php echo $mobil['id']; ?>" class="btn">Sewa Mobil</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - PT Bandi Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:#DCDCDC;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            height: 100vh;
            padding: 20px;
            color: white;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .sidebar-menu {
            list-style-type: none;
            padding: 0;
        }
        .sidebar-menu li {
            margin-bottom: 10px;
        }
        .sidebar-menu a {
            color: white;
            text-decoration: none;
        }
        .dashboard-card {
            background-color: white;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['level'] != 'admin') {
        header("Location: login.php");
        exit();
    }

    $query_mobil = "SELECT COUNT(*) as total_mobil FROM mobil";
    $query_penyewaan = "SELECT COUNT(*) as total_penyewaan FROM penyewaan";
    $query_pendapatan = "SELECT SUM(total_biaya) as total_pendapatan FROM penyewaan";

    $result_mobil = mysqli_query($koneksi, $query_mobil);
    $result_penyewaan = mysqli_query($koneksi, $query_penyewaan);
    $result_pendapatan = mysqli_query($koneksi, $query_pendapatan);

    $total_mobil = mysqli_fetch_assoc($result_mobil)['total_mobil'];
    $total_penyewaan = mysqli_fetch_assoc($result_penyewaan)['total_penyewaan'];
    $total_pendapatan = mysqli_fetch_assoc($result_pendapatan)['total_pendapatan'];
    ?>
    <div class="container">
        <div class="sidebar">
            <h2>Admin Menu</h2>
            <ul class="sidebar-menu">
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="kelola_mobil.php">Kelola Mobil</a></li>
                <li><a href="kelola_penyewaan.php">Kelola Penyewaan</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Dashboard Admin</h1>
            <div class="card-grid">
                <div class="dashboard-card">
                    <h3>Total Mobil</h3>
                    <p><?php echo $total_mobil; ?></p>
                </div>
                <div class="dashboard-card">
                    <h3>Total Penyewaan</h3>
                    <p><?php echo $total_penyewaan; ?></p>
                </div>
                <div class="dashboard-card">
                    <h3>Total Pendapatan</h3>
                    <p>Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
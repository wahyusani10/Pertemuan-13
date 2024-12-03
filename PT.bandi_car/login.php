<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - PT Bandi Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #DCDCDC;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = MD5($_POST['password']);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($koneksi, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];

            if ($user['level'] == 'admin') {
                header("Location: Admin_dasboard.php");
            } else {
                header("Location: penyewa_dasboard.php");
            }
        } else {
            $error = "Username atau password salah!";
        }
    }
    ?>
    <div class="login-container">
        <h2>Login PT Bandi Car</h2>
        <?php if(isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Login Sebagai</label>
                <select name="role" required>
                    <option value="tenant">Penyewa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
<?php
include "koneksi.php";
$e = isset($_GET['e']) ? $_GET['e'] : null;
$title = empty($e) ? "Tambah User" : "Edit User";
$data = ['username' => '', 'password' => '', 'level' => '']; 

if (!empty($e)) {
    $username = mysqli_real_escape_string($conn, $_GET['username']);
    $q = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    
    if ($q) {
        $data = mysqli_fetch_array($q, MYSQLI_ASSOC);
    } else {
        die("Query failed: " . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title; ?></title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <form method="post" action="Lat5_3.php">
        <input type="hidden" name="e" value="<?php echo htmlspecialchars($data['username']); ?>" />
        <table border="1">
            <tr>
                <td>Username</td>
                <td>
                    <input name="username" type="text" value="<?php echo htmlspecialchars($data['username']); ?>" />
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input name="password" type="text" value="<?php echo htmlspecialchars($data['password']); ?>" />
                </td>
            </tr>
            <tr>
                <td>Level</td>
                <td>
                    <input name="level" type="text" value="<?php echo htmlspecialchars($data['level']); ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Submit" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

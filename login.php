<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Đăng nhập</title>
<link rel="stylesheet" href="assets/bootstrap.min.css"></head>
<body class="container">
<h2 class="mt-5">Đăng nhập</h2>
<form method="post">
    <input type="text" name="username" class="form-control mb-2" placeholder="Tài khoản" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Mật khẩu" required>
    <button type="submit" class="btn btn-primary">Đăng nhập</button>
    <?php if(isset($error)) echo "<p class='text-danger mt-2'>$error</p>"; ?>
</form>
</body>
</html>
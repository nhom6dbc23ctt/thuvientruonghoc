<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");
?>
<?php include 'header.php'; ?>
<h3>Chào, <?php echo $_SESSION['user']['username']; ?>!</h3>
<ul>
    <li><a href="books.php">Quản lý sách</a></li>
    <li><a href="borrow.php">Mượn sách</a></li>
    <li><a href="return.php">Trả sách</a></li>
    <li><a href="logout.php">Đăng xuất</a></li>
</ul>
<?php include 'footer.php'; ?>
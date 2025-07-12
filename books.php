<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] == 'user') die("Không có quyền");
include 'db.php';

if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $qty = $_POST['quantity'];
    mysqli_query($conn, "INSERT INTO books (title, author, quantity) VALUES ('$title','$author',$qty)");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM books WHERE id=$id");
}

$books = mysqli_query($conn, "SELECT * FROM books");
?>
<?php include 'header.php'; ?>
<h3>Quản lý sách</h3>
<form method="post" class="mb-3">
    <input name="title" placeholder="Tên sách" required>
    <input name="author" placeholder="Tác giả" required>
    <input name="quantity" type="number" value="1" required>
    <button class="btn btn-success">Thêm sách</button>
</form>
<table class="table">
    <tr><th>Tên sách</th><th>Tác giả</th><th>Số lượng</th><th></th></tr>
    <?php while($b = mysqli_fetch_assoc($books)): ?>
        <tr>
            <td><?= $b['title'] ?></td>
            <td><?= $b['author'] ?></td>
            <td><?= $b['quantity'] ?></td>
            <td><a href="?delete=<?= $b['id'] ?>" onclick="return confirm('Xóa?')" class="btn btn-danger btn-sm">Xóa</a></td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include 'footer.php'; ?>
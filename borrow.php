<?php
session_start();
if (!isset($_SESSION['user'])) die("Cần đăng nhập");
include 'db.php';

if (isset($_POST['book_id'])) {
    $uid = $_SESSION['user']['id'];
    $bid = $_POST['book_id'];
    $today = date('Y-m-d');
    mysqli_query($conn, "INSERT INTO borrow_records (user_id, book_id, borrow_date) VALUES ($uid, $bid, '$today')");
    mysqli_query($conn, "UPDATE books SET quantity = quantity - 1 WHERE id = $bid");
}

$books = mysqli_query($conn, "SELECT * FROM books WHERE quantity > 0");
?>
<?php include 'header.php'; ?>
<h3>Mượn sách</h3>
<form method="post">
    <select name="book_id">
        <?php while($b = mysqli_fetch_assoc($books)): ?>
        <option value="<?= $b['id'] ?>"><?= $b['title'] ?> - <?= $b['author'] ?></option>
        <?php endwhile; ?>
    </select>
    <button class="btn btn-primary">Mượn</button>
</form>
<?php include 'footer.php'; ?>
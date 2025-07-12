<?php
session_start();
if (!isset($_SESSION['user'])) die("Cần đăng nhập");
include 'db.php';

if (isset($_POST['record_id'])) {
    $rid = $_POST['record_id'];
    $today = date('Y-m-d');
    $record = mysqli_fetch_assoc(mysqli_query($conn, "SELECT book_id FROM borrow_records WHERE id = $rid"));
    mysqli_query($conn, "UPDATE borrow_records SET return_date = '$today' WHERE id = $rid");
    mysqli_query($conn, "UPDATE books SET quantity = quantity + 1 WHERE id = ".$record['book_id']);
}

$uid = $_SESSION['user']['id'];
$records = mysqli_query($conn, "SELECT br.id, b.title, br.borrow_date FROM borrow_records br JOIN books b ON br.book_id = b.id WHERE br.user_id=$uid AND return_date IS NULL");
?>
<?php include 'header.php'; ?>
<h3>Trả sách</h3>
<form method="post">
    <select name="record_id">
        <?php while($r = mysqli_fetch_assoc($records)): ?>
        <option value="<?= $r['id'] ?>"><?= $r['title'] ?> - mượn ngày <?= $r['borrow_date'] ?></option>
        <?php endwhile; ?>
    </select>
    <button class="btn btn-warning">Trả</button>
</form>
<?php include 'footer.php'; ?>
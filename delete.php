<?php
include 'db_connection.php';
// Delete record when delete button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    $deleteSql = "DELETE FROM user WHERE id = $deleteId";
    $conn->query($deleteSql);
    header("Location: display_users.php");
    exit();
}
?>
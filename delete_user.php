<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM users WHERE user_id='$id'");

echo "<script>
alert('User deleted successfully.');
window.location='view_users.php';
</script>";
exit();
?>

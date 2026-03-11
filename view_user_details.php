<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$res = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$id'");
$user = mysqli_fetch_assoc($res);

if (!$user) {
    header("Location: view_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Details</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php include 'nav.php'; ?>

<div class="box">

<h2>User Details</h2>

<p><b>User ID:</b> <?= $user['user_id'] ?></p>
<p><b>Name:</b> <?= $user['name'] ?></p>
<p><b>Email:</b> <?= $user['email'] ?></p>
<p><b>Role:</b> <?= $user['role'] ?></p>

<a href="view_users.php">Back</a>

</div>

</body>
</html>
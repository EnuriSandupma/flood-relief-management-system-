<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Relief Management System</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php include 'nav.php'; ?>

<div class="box">

<h2>Welcome to Flood Relief Management System</h2>

<p>This system helps manage flood relief requests in Sri Lanka.</p>

<p>Use the navigation menu above to manage users, requests, and reports.</p>

<?php if($_SESSION['role'] == 'admin'){ ?>

<a href="admin_dashboard.php">Go to Admin Dashboard</a>

<?php } else { ?>

<a href="user_dashboard.php">Go to User Dashboard</a>

<?php } ?>

</div>

</body>
</html>
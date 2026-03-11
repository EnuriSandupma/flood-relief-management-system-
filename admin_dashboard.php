<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$totalUsers = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM users"))['t'];

$highSeverity = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE severity_level='High'"))['t'];

$food = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE relief_type='Food'"))['t'];

$medicine = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE relief_type='Medicine'"))['t'];

$shelter = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE relief_type='Shelter'"))['t'];

?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php include 'nav.php'; ?>

<div class="box">

<h2>Admin Dashboard</h2>

<p><b>Total Registered Users:</b> <?= $totalUsers ?></p>

<p><b>High Severity Households:</b> <?= $highSeverity ?></p>

<p><b>Food Requests:</b> <?= $food ?></p>

<p><b>Medicine Requests:</b> <?= $medicine ?></p>

<p><b>Shelter Requests:</b> <?= $shelter ?></p>

<br>

<a href="view_users.php">Manage Users</a>

<a href="reports.php">View Reports</a>

<a href="logout.php">Logout</a>

</div>

</body>
</html>
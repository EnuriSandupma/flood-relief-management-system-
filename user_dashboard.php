<?php
session_start();
if ($_SESSION['role'] != 'user') header("Location: login.php");
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
<h2>User Dashboard</h2>
<a href="create_request.php">Create Relief Request</a><br><br>
<a href="view_requests.php">View My Requests</a><br><br>
<a href="logout.php">Logout</a>
</div>
</body>
</html>

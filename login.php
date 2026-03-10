<?php 
session_start(); 
include 'db.php'; 

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pw = $_POST['password'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($res);

    if ($row && password_verify($pw, $row['password'])) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role'] = $row['role'];
        if ($row['role']=='admin') header("Location: index.php");
        else header("Location: index.php");
        exit();
    } else {
        $error = "Invalid login";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<form method="post">
<h2>Login</h2>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
<?php
if (isset($error)) {
    echo "<script>alert('$error');</script>";
}
?>
</body>
</html>

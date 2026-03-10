<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<script>
function validateForm() {
    let pw = document.getElementById("password").value;
    if (pw.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }
    return true;
}
</script>
</head>
<body>

<form method="post" onsubmit="return validateForm();">
<h2>Register</h2>
<input type="text" name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" id="password" name="password" placeholder="Password" required>
<button name="register">Register</button>
<a href="login.php">Login</a>
</form>

<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (name,email,password) VALUES ('$name','$email','$pw')");
    echo "<script>alert('Registration successful');</script>";
}
?>
</body>
</html>

<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already exists";
    } else {
        mysqli_query($conn, "INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$pw','$role')");

        echo "<script>
        alert('User added successfully.');
        window.location='view_users.php';
        </script>";
        exit();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Relief Management System</title>
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
<?php include 'nav.php'; ?>

<form method="post" onsubmit="return validateForm();">
<h2>Add New User</h2>
<?php if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
<input type="text" name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" id="password" name="password" placeholder="Password" required>
<select name="role" required>
<option value="">Select Role</option>
<option value="user">User</option>
<option value="admin">Admin</option>
</select>
<button name="add_user">Add User</button>
</form>
</body>
</html>

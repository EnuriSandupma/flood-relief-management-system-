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

if (isset($_POST['update_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_id!='$id'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already exists";
    } else {
        if (!empty($_POST['password'])) {
            $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$pw', role='$role' WHERE user_id='$id'");
        } else {
            mysqli_query($conn, "UPDATE users SET name='$name', email='$email', role='$role' WHERE user_id='$id'");

            echo "<script>
            alert('User updated successfully.');
            window.location='view_users.php';
            </script>";
            exit();
        }
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
    if (pw.length > 0 && pw.length < 6) {
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
<h2>Update User</h2>
<?php if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
<input type="text" name="name" placeholder="Name" value="<?= $user['name'] ?>" required>
<input type="email" name="email" placeholder="Email" value="<?= $user['email'] ?>" required>
<input type="password" id="password" name="password" placeholder="New Password (leave blank to keep current)">
<select name="role" required>
<option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
<option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
</select>
<button name="update_user">Update User</button>
</form>
</body>
</html>

<?php
session_start();
include 'db.php';
$res = mysqli_query($conn,"SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Relief Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'nav.php'; ?>
<div style="text-align:center; margin:20px;">
<a href="add_user.php" style="background:#667eea; color:white; padding:12px 30px; border-radius:6px; text-decoration:none; display:inline-block; font-weight:600;">+ Add New User</a>
</div>
<script>
function confirmDelete(){ return confirm("Delete user?"); }
</script>
<table>
<tr><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
<?php while ($u = mysqli_fetch_assoc($res)) { ?>
<tr>
<td><?= $u['name'] ?></td>
<td><?= $u['email'] ?></td>
<td><?= $u['role'] ?></td>
<td>
<a href="view_user_details.php?id=<?= $u['user_id'] ?>">View</a> |
<a href="update_user.php?id=<?= $u['user_id'] ?>">Update</a> |
<a href="delete_user.php?id=<?= $u['user_id'] ?>" onclick="return confirmDelete();">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</body>
</html>

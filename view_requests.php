<?php
session_start();
include 'db.php';
$uid = $_SESSION['user_id'];
$res = mysqli_query($conn, "SELECT * FROM relief_requests WHERE user_id='$uid'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Relief Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'nav.php'; ?>
<script>
function confirmDelete(){ return confirm("Are you sure?"); }
</script>
<table>
<tr><th>Type</th><th>District</th><th>Severity</th><th>Action</th></tr>
<?php while ($r = mysqli_fetch_assoc($res)) { ?>
<tr>
<td><?= $r['relief_type'] ?></td>
<td><?= $r['district'] ?></td>
<td><?= $r['severity_level'] ?></td>
<td>
<a href="update_request.php?id=<?= $r['request_id'] ?>">Update</a> | 
<a href="delete_request.php?id=<?= $r['request_id'] ?>" onclick="return confirmDelete();">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</body>
</html>

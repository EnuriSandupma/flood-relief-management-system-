<?php
session_start();
include 'db.php';

$id = $_GET['id'];
$uid = $_SESSION['user_id'];

$res = mysqli_query($conn, "SELECT * FROM relief_requests WHERE request_id='$id' AND user_id='$uid'");
$request = mysqli_fetch_assoc($res);

if (!$request) {
    header("Location: view_requests.php");
    exit();
}

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE relief_requests SET
    relief_type='$_POST[relief_type]',
    district='$_POST[district]',
    divisional_secretariat='$_POST[ds]',
    gn_division='$_POST[gn]',
    contact_name='$_POST[cname]',
    contact_number='$_POST[cnumber]',
    address='$_POST[address]',
    family_members='$_POST[family]',
    severity_level='$_POST[severity]',
    description='$_POST[description]'
    WHERE request_id='$id' AND user_id='$uid'");

    echo "<script>
    alert('Relief request updated successfully.');
    window.location='view_requests.php';
    </script>";
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

<form method="post">
<h2>Update Relief Request</h2>
<select name="relief_type">
<option <?= $request['relief_type']=='Food'?'selected':'' ?>>Food</option>
<option <?= $request['relief_type']=='Water'?'selected':'' ?>>Water</option>
<option <?= $request['relief_type']=='Medicine'?'selected':'' ?>>Medicine</option>
<option <?= $request['relief_type']=='Shelter'?'selected':'' ?>>Shelter</option>
</select>
<input name="district" placeholder="District" value="<?= $request['district'] ?>" required>
<input name="ds" placeholder="Divisional Secretariat" value="<?= $request['divisional_secretariat'] ?>" required>
<input name="gn" placeholder="GN Division" value="<?= $request['gn_division'] ?>" required>
<input name="cname" placeholder="Contact Name" value="<?= $request['contact_name'] ?>">
<input name="cnumber" placeholder="Contact Number" value="<?= $request['contact_number'] ?>">
<textarea name="address" placeholder="Address"><?= $request['address'] ?></textarea>
<input type="number" name="family" placeholder="Family Members" value="<?= $request['family_members'] ?>">
<select name="severity">
<option <?= $request['severity_level']=='Low'?'selected':'' ?>>Low</option>
<option <?= $request['severity_level']=='Medium'?'selected':'' ?>>Medium</option>
<option <?= $request['severity_level']=='High'?'selected':'' ?>>High</option>
</select>
<textarea name="description" placeholder="Description"><?= $request['description'] ?></textarea>
<button name="update">Update Request</button>
</form>
</body>
</html>

<?php
session_start();
include 'db.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$district = "";
$type = "";
$where = "WHERE 1";

if(isset($_GET['district']) && $_GET['district'] != ""){
    $district = $_GET['district'];
    $where .= " AND district='$district'";
}

if(isset($_GET['type']) && $_GET['type'] != ""){
    $type = $_GET['type'];
    $where .= " AND relief_type='$type'";
}

$totalUsers = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM users"))['t'];
$highSeverity = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE severity_level='High'"))['t'];
$food = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE relief_type='Food'"))['t'];
$medicine = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE relief_type='Medicine'"))['t'];
$shelter = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM relief_requests WHERE relief_type='Shelter'"))['t'];

$requests = mysqli_query($conn,"SELECT * FROM relief_requests $where");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Reports</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php include 'nav.php'; ?>

<div class="box">

<h2>System Summary</h2>

<p><b>Total Registered Users:</b> <?= $totalUsers ?></p>
<p><b>High Severity Households:</b> <?= $highSeverity ?></p>
<p><b>Food Requests:</b> <?= $food ?></p>
<p><b>Medicine Requests:</b> <?= $medicine ?></p>
<p><b>Shelter Requests:</b> <?= $shelter ?></p>

</div>





<form method="get">
<h2>Filter Reports</h2>
<select name="district">

<option value="">Select District</option>

<option value="Colombo" <?= ($district=='Colombo')?'selected':'' ?>>Colombo</option>
<option value="Gampaha" <?= ($district=='Gampaha')?'selected':'' ?>>Gampaha</option>
<option value="Kalutara" <?= ($district=='Kalutara')?'selected':'' ?>>Kalutara</option>
<option value="Kandy" <?= ($district=='Kandy')?'selected':'' ?>>Kandy</option>
<option value="Galle" <?= ($district=='Galle')?'selected':'' ?>>Galle</option>
<option value="Matara" <?= ($district=='Matara')?'selected':'' ?>>Matara</option>
<option value="Hambantota" <?= ($district=='Hambantota')?'selected':'' ?>>Hambantota</option>
<option value="Kurunegala" <?= ($district=='Kurunegala')?'selected':'' ?>>Kurunegala</option>
<option value="Puttalam" <?= ($district=='Puttalam')?'selected':'' ?>>Puttalam</option>
<option value="Anuradhapura" <?= ($district=='Anuradhapura')?'selected':'' ?>>Anuradhapura</option>
<option value="Polonnaruwa" <?= ($district=='Polonnaruwa')?'selected':'' ?>>Polonnaruwa</option>
<option value="Badulla" <?= ($district=='Badulla')?'selected':'' ?>>Badulla</option>
<option value="Monaragala" <?= ($district=='Monaragala')?'selected':'' ?>>Monaragala</option>
<option value="Ratnapura" <?= ($district=='Ratnapura')?'selected':'' ?>>Ratnapura</option>
<option value="Kegalle" <?= ($district=='Kegalle')?'selected':'' ?>>Kegalle</option>
<option value="Nuwara Eliya" <?= ($district=='Nuwara Eliya')?'selected':'' ?>>Nuwara Eliya</option>
<option value="Ampara" <?= ($district=='Ampara')?'selected':'' ?>>Ampara</option>
<option value="Batticaloa" <?= ($district=='Batticaloa')?'selected':'' ?>>Batticaloa</option>
<option value="Trincomalee" <?= ($district=='Trincomalee')?'selected':'' ?>>Trincomalee</option>
<option value="Jaffna" <?= ($district=='Jaffna')?'selected':'' ?>>Jaffna</option>
<option value="Kilinochchi" <?= ($district=='Kilinochchi')?'selected':'' ?>>Kilinochchi</option>
<option value="Mannar" <?= ($district=='Mannar')?'selected':'' ?>>Mannar</option>
<option value="Mullaitivu" <?= ($district=='Mullaitivu')?'selected':'' ?>>Mullaitivu</option>
<option value="Vavuniya" <?= ($district=='Vavuniya')?'selected':'' ?>>Vavuniya</option>

</select>

<select name="type">

<option value="">Relief Type</option>
<option value="Food" <?= ($type=='Food')?'selected':'' ?>>Food</option>
<option value="Water" <?= ($type=='Water')?'selected':'' ?>>Water</option>
<option value="Medicine" <?= ($type=='Medicine')?'selected':'' ?>>Medicine</option>
<option value="Shelter" <?= ($type=='Shelter')?'selected':'' ?>>Shelter</option>

</select>

<button type="submit">Filter</button>

</form>



<table>

<tr>
<th>Relief Type</th>
<th>District</th>
<th>Severity</th>
<th>Family Members</th>
</tr>

<?php while($r = mysqli_fetch_assoc($requests)){ ?>

<tr>
<td><?= $r['relief_type'] ?></td>
<td><?= $r['district'] ?></td>
<td><?= $r['severity_level'] ?></td>
<td><?= $r['family_members'] ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>
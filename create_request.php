<?php
session_start();
include 'db.php';

if (isset($_POST['submit'])) {

    $uid = $_SESSION['user_id'];

    mysqli_query($conn, "INSERT INTO relief_requests
    (user_id,relief_type,district,divisional_secretariat,gn_division,contact_name,contact_number,address,family_members,severity_level,description)
    VALUES
    ('$uid','$_POST[relief_type]','$_POST[district]','$_POST[ds]','$_POST[gn]','$_POST[cname]','$_POST[cnumber]','$_POST[address]','$_POST[family]','$_POST[severity]','$_POST[description]')");

    echo "<script>
    alert('Your relief request has been created successfully.');
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
<h2>Create Relief Request</h2>
<select name="relief_type">
<option>Food</option><option>Water</option><option>Medicine</option><option>Shelter</option>
</select>
<input name="district" placeholder="District" required>
<input name="ds" placeholder="Divisional Secretariat" required>
<input name="gn" placeholder="GN Division" required>
<input name="cname" placeholder="Contact Name">
<input name="cnumber" placeholder="Contact Number">
<textarea name="address" placeholder="Address"></textarea>
<input type="number" name="family" placeholder="Family Members">
<select name="severity">
<option>Low</option><option>Medium</option><option>High</option>
</select>
<textarea name="description" placeholder="Description"></textarea>
<button name="submit">Submit</button>
</form>
</body>
</html>

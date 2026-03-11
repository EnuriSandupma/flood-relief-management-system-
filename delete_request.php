<?php
include 'db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM relief_requests WHERE request_id='$id'");
echo "<script>
alert('Relief request deleted successfully.');
window.location='view_requests.php';
</script>";
?>

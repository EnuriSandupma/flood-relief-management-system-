<?php
$conn = mysqli_connect("localhost", "root", "", "flood_relief_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
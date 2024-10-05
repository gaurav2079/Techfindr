<?php
include 'partials/config.php';
session_start();
$query = "SELECT * from userdetail";
$result = mysqli_query($conn, $query);
$type = $_row['user_type'];
$_SESSION['type'] = $type;
?>
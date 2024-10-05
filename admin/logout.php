<?php

session_start();
//$_SESSION = array();
unset($_SESSION["logged_in"]);
unset($_SESSION["adminname"]);
session_destroy();

header("location: index.php");
?>

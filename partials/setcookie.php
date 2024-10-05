<?php
require_once 'config.php';


setcookie("username", $username, time() +86400);
setcookie("usertype", $user_type, time() +86400);
?>
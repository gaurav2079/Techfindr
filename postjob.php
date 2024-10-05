<?php
session_start();
$isSignedIn = isset($_SESSION['username']);
            if ($isSignedIn)
            {
                    include 'offerjob.php';
            }
            else
            {
                echo "<h1> You need to login First</h1>";
                header("Refresh:1 ; URL=login.php");
            }
?>
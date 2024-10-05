<?php
session_start();
// check if the admin is already logged in
if(isset($_SESSION["adminname"]))
{
    header("location: dashboard.php");
    exit;
}
require_once "config/dbconnect.php";

$adminname = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['admin_name'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter Admin Name and Password";
        echo "<script>alert('$err');</script>";
    }
    else{
        $adminname = trim($_POST['admin_name']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, admin_name ,admin_password FROM admin_detail WHERE admin_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    $param_admin_name = $adminname;
    mysqli_stmt_bind_param($stmt, "s", $param_admin_name);
    
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $adminname, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                           // die("admin login");
                            $_SESSION["adminname"] = $adminname;
                            $_SESSION["id"] = $id;
                            $_SESSION["logged_in"] = true;

                            //Redirect user to welcome page
                            header("location: dashboard.php");
                            
                        }
                        else{
                            $err = "Admin Name and Password did not match.";
                            echo "<script>alert('$err');</script>";
                        }
                    }

                }
                else{
                    $err = "This admin is not registered..";
                    echo "<script>alert('$err');</script>";
                }

    }
}    


}


?>






<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <title>TechFindr-Admin Login</title>
</head>
<body>
    <div class="wrapper-right">

            <div class="title">
                <h1>Welcome Back,</h1>
                <p>Sign In to your account</p>
            </div>
            <form action="" method="post">
                <div class="form-card">
                    <span class="label">Admin Name</span>
                    <div class="input-box">
                        <input type="text" id="adminname" name = "admin_name" placeholder="Enter Admin Name">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
                <div class="form-card">
                    <span class="label">Password</span>
                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Enter Admin Password">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </div>
                </div>
                <input type="submit" value="Login" class="login-btn">
            </form>
        </div>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>

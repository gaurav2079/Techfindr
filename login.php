<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: index.php");
    exit;
}
require_once "partials/config.php";

$username = $password = $user_type = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username and password";
        echo "<script>alert('$err');</script>";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT user_id,username,password FROM userdetail WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    $param_username = $username;
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;
                            // $_SESSION["isSignedIn"] = true;

                            //Redirect user to welcome page
                            header("location: index.php");
                            
                        }
                        else{
                            $err = "Username and password do not match.";
                            echo "<script>alert('$err');</script>";
                        }
                    }

                }
                else{
                    $err = "This user is not registered..";
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
    

    <title>TechFindr-Login</title>
</head>
<body>
    <div class="wrapper-right">
            <div class="signup">
                <p>Do not have an account?</p>
                <button class="signup-btn" onclick="location.href='register.php'">Sign Up </button>

                &nbsp;&nbsp; 
                <div class="back">
                    <a href="index.php"><i class="fas fa-times"></i></a>
                </div>
            </div>

            <div class="title">
                <h1>Welcome Back,</h1>
                <p>Sign In to your account</p>
            </div>
            <form action="" method="post">
                <div class="form-card">
                    <span class="label">Username</span>
                    <div class="input-box">
                        <input type="text" id="username" name = "username" placeholder="Username">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
                <div class="form-card">
                    <span class="label">Password</span>
                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password">
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

<?php
require_once "config/dbconnect.php";
session_start();

if(isset($_SESSION['adminname']))
{
    header("location: index.php");
    exit;
}

$adminname = $password = $confirm_password = "";
$adminname_err = $password_err = $confirm_password_err =  "";





if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if adminname is empty
    if(empty(trim($_POST["adminname"]))){
        $adminname_err = "adminname cannot be blank";
        echo "<script>alert('$adminname_err');</script>";
    }
    else{
        $sql = "SELECT id FROM admin_detail WHERE adminname = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_adminname);

            // Set the value of param adminname
            $param_adminname = trim($_POST['adminname']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $adminname_err = "adminname is already taken. Please choose a different adminname.";
                    echo "<script>alert('$adminname_err');</script>";
                }
                else{
                    $adminname = trim($_POST['adminname']);
                }
            }
            else{
                echo "<script>alert('something went wrong');</script>";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
    echo "<script>alert('$password_err');</script>";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
    echo "<script>alert('$password_err');</script>";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
    echo "<script>alert('$password_err');</script>";
}



// If there were no errors, go ahead and insert into the database
if(empty($adminname_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO admin_detail (adminname, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {

        // Set these parameters
        $param_adminname = $adminname;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        


        mysqli_stmt_bind_param($stmt, "ss", $param_adminname, $param_password);

        

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);

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

    <title>TechFindr-Register</title>
</head>
<body>
    <div class="wrapper-right">
            <div class="signup">
                <p>Already have an account?</p>
                <button class="signup-btn" onclick="location.href='login.php'">Login </button>

                &nbsp;&nbsp; 
                <div class="back">
                    <a href="index.php"><i class="fas fa-times"></i></a>
                </div>
            </div>

            <div class="title">
                <h1>Welcome,</h1>
                <p>Register as an admin for TechFindr</p>
            </div>
            <form action="" method = "post">


                <div class="form-card">
                    <span class="label">Admin Name</span>
                    <div class="input-box">
                        <input type="text"  name = "adminname" id="adminname" placeholder="Adminname">
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
                <div class="form-card">
                    <span class="label">Confirm Password</span>
                    <div class="input-box">
                        <input type="password" name="confirm_password" id="cpassword" placeholder="Re-Type your Password">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </div>
                </div>
                <input type="submit" class="login-btn" value="Register Now">
            </form>
        </div>
    <script src="app.js"></script>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>

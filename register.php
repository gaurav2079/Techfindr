<?php
// Include the database connection code
require_once 'partials/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Perform basic validation
    if (empty($username) || empty($email) || empty($number) || empty($password) || empty($confirm_password)) {
        // Handle empty fields
        $err = "Please fill all the details.";
        echo "<script>alert('$err');</script>";
    } elseif ($password !== $confirm_password) {
        // Handle password mismatch
        $err = "Passwords do not match.";
        echo "<script>alert('$err');</script>";
    } else {
        // All data is valid, proceed with database insertion

        // Check if the username already exists in the database
        $check_sql = "SELECT * FROM userdetail WHERE username = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // Username already exists
            $err = "Username already exists. Choose a different one.";
            echo "<script>alert('$err');</script>";
        } else {

            // Hash the password for security (you may use a stronger hashing method)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            
            // Prepare the SQL query to insert data into the table
            $sql = "INSERT INTO userdetail (username, user_type, email, contact_number, password) VALUES (?, ?, ?, ?, ?)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Bind parameters to the statement
            $stmt->bind_param("sssss", $username, $user_type, $email, $number, $hashed_password);

            // Execute the statement to insert data
            if ($stmt->execute()) {
                // Data inserted successfully
                header("location: login.php");
                exit(); // Stop further execution
            } else {
                // Failed to insert data
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        
        }

        // Close the check statement and database connection
        $check_stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;

        }
    </style>
    <title>TechFindr-Register</title>
</head>
<body>
    <div class="wrapper-right">
        <div class="signup">
            <p>Already have an account?</p>
            <button class="signup-btn" onclick="location.href='login.php'">Login</button>
            &nbsp;&nbsp;
            <div class="back">
                <a href="index.php"><i class="fas fa-times"></i></a>
            </div>
        </div>

        <div class="title">
            <h1>Welcome,</h1>
            <p>Register to TechFindr</p>
        </div>
        <form action="" method="post" id="registrationForm">
            <div class="form-card">
                <span class="label">Username</span>
                <div class="input-box">
                    <input type="text" name="username" id="username" placeholder="Username">
                    <ion-icon name="person-outline"></ion-icon>
                </div>
                <span id="username_err" class="error"></span>
            </div>

            <div class="form-card">
                <span class="label">User Type</span>
                <div class="input-box">
                    <select name="user_type">
                        <option value="Seeker">Job Seeker</option>
                        <option value="Provider">Job Provider</option>
                    </select>
                </div>
            </div>

            <br><br>

            <div class="form-card">
                <span class="label">Email</span>
                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="E-Mail">
                    <ion-icon name="mail-outline"></ion-icon>
                </div>
                <span id="email_err" class="error"></span>
            </div>

            <div class="form-card">
                <span class="label">Phone Number</span>
                <div class="input-box">
                    <input type="text" name="number" id="number" placeholder="Contact Number">
                    <ion-icon name="call-outline"></ion-icon>
                </div>
                <span id="number_err" class="error"></span>
            </div>

            <div class="form-card">
                <span class="label">Password</span>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </div>
                <span id="password_err" class="error"></span>
            </div>

            <div class="form-card">
                <span class="label">Confirm Password</span>
                <div class="input-box">
                    <input type="password" name="confirm_password" id="cpassword" placeholder="Re-Type your Password">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                </div>
                <span id="cpassword_err" class="error"></span>
            </div>

            <input type="submit" class="login-btn" value="Register Now" id="registerButton" disabled>

        </form>
    </div>
    <script type="module">
        // Function to validate the Username field
        function validateUsername(username) {
            var usernameRegex = /^[a-zA-Z][a-zA-Z0-9]*$/;
            return usernameRegex.test(username);
        }

        // Function to validate the Email field
        function validateEmail(email) {
            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
            return emailRegex.test(email);
        }

        // Function to validate the Phone Number field
        function validatePhoneNumber(number) {
            var numberRegex = /^(98|97)\d{8}$/;
            return numberRegex.test(number);
        }

        // Function to validate the Password field
        function validatePassword(password) {
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        return passwordRegex.test(password);
    }

        // Function to perform real-time validation for each field on key press
        $(document).ready(function() {
            $("#username").on("keyup", function() {
                var username = $(this).val();
                var errorSpan = $("#username_err");
                if (validateUsername(username)) {
                    errorSpan.text("");
                } else {
                    errorSpan.text("Invalid Username. Only alphabets are allowed.");
                }
            });

            $("#email").on("keyup", function() {
                var email = $(this).val();
                var errorSpan = $("#email_err");
                if (validateEmail(email)) {
                    errorSpan.text("");
                } else {
                    errorSpan.text("Invalid Email.");
                }
            });

            $("#number").on("keyup", function() {
                var number = $(this).val();
                var errorSpan = $("#number_err");
                if (validatePhoneNumber(number)) {
                    errorSpan.text("");
                } else {
                    errorSpan.text("Invalid Phone Number. Please enter 10 digits.");
                }
            });

            $("#password, #cpassword").on("keyup", function() {
                var password = $("#password").val();
                var cpassword = $("#cpassword").val();
                var passwordErrorSpan = $("#password_err");
                var cpasswordErrorSpan = $("#cpassword_err");

                if (validatePassword(password)) {
                    passwordErrorSpan.text("");
                } else {
                    passwordErrorSpan.text("Password must be at least 8 characters and contain at least one lowercase letter, one uppercase letter, and one number.");
                }

                if (password === cpassword) {
                    cpasswordErrorSpan.text("");
                } else {
                    cpasswordErrorSpan.text("Passwords do not match.");
                }
            });

             // Enable the "Register Now" button only when all fields are valid
    $("#registrationForm input").on("keyup", function() {
        var username = $("#username").val();
        var email = $("#email").val();
        var number = $("#number").val();
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();

        if (
            validateUsername(username) &&
            validateEmail(email) &&
            validatePhoneNumber(number) &&
            validatePassword(password) &&
            password === cpassword
        ) {
            $("#registerButton").prop("disabled", false);
        } else {
            $("#registerButton").prop("disabled", true);
        }
    });
        });
    </script>
</body>
</html>

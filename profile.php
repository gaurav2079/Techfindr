<?php
// profile.php

// Start the session and include the database configuration
session_start();
include_once 'partials/config.php';

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user details from the userdetail table based on the user ID
$userID = $_SESSION['id'];
$query = "SELECT * FROM userdetail WHERE user_id = '$userID'";
$result = mysqli_query($conn, $query);

// Check if the user details are found
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Get user details
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $row['email'];
    $username = $row['username'];
    $contactNumber = $row['contact_number'];
    // Add more fields if needed

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to some error page if user details not found
    header("Location: error.php");
    exit();
}

// Handle password change form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    // Hash the new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateQuery = "UPDATE userdetail SET password = '$hashedPassword' WHERE user_id = '$userID'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0">User Profile</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile Picture (You can add an image here) -->
                        <img src="profile_picture.jpg" class="img-fluid rounded-circle" alt="Profile Picture">
                    </div>
                    <div class="col-md-8">
                        <!-- User Details -->
                        <h4><?php echo $firstName . ' ' . $lastName; ?></h4>
                        <p><strong>Username:</strong> <?php echo $username; ?></p>
                        <p><strong>Email:</strong> <?php echo $email; ?></p>
                        <p><strong>Contact Number:</strong> <?php echo $contactNumber; ?></p>
                        <!-- Add more user details here if needed -->
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="logout.php" class="btn btn-danger float-right">Logout</a>
                <button type="button" class="btn btn-primary float-right mr-2" data-toggle="modal" data-target="#changePasswordModal">
                    Change Password
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post

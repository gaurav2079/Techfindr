<?php
// Include the database conn configuration
include 'config/dbconnect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    // Update the user details in the userdetail table
    $sql = "UPDATE userdetail SET username = '$username', contact_number = '$contact_number', email = '$email', user_type = '$user_type' WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "User details updated successfully.";
        header("Refresh:1 ; URL=viewusers.php");
    } else {
        echo "Error updating user details: " . mysqli_error($conn);
    }
}

// Close the database conn
mysqli_close($conn);
?>

<?php
// Include the database conn configuration
include 'config/dbconnect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID
    $applicant_id = $_POST['applicant_id'];

    // Delete the user from the userdetail table
    $sql = "DELETE FROM applicants WHERE applicant_id = '$applicant_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Applicant deleted successfully.";
        header("Refresh:1 ; URL=applications.php");
    } else {
        echo "Error deleting applicant: " . mysqli_error($conn);
    }
}

// Close the database conn
mysqli_close($conn);
?>

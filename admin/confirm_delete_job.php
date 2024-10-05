<?php
// Include the database connection configuration
include 'config/dbconnect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the job ID
    $job_id = $_POST['job_id'];

    // Step 1: Delete applicants associated with the job
    $delete_applicants_sql = "DELETE FROM applicants WHERE job_id = '$job_id'";
    $result_applicants = mysqli_query($conn, $delete_applicants_sql);

    if (!$result_applicants) {
        echo "Error deleting applicants: " . mysqli_error($conn);
        exit; // Stop execution if there's an error
    }

    // Step 2: Delete the job from the job_detail table
    $delete_job_sql = "DELETE FROM job_detail WHERE job_id = '$job_id'";
    $result_job = mysqli_query($conn, $delete_job_sql);

    if ($result_job) {
        echo "Job and associated applicants deleted successfully.";
        header("Refresh:1 ; URL=jobs.php");
    } else {
        echo "Error deleting Job: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

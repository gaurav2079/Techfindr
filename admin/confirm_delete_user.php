<?php
// Include the database connection configuration
include 'config/dbconnect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID
    $user_id = $_POST['user_id'];

    // Delete related records from the job_detail table
    $sql_delete_jobs = "DELETE FROM job_detail WHERE user_id = '$user_id'";
    $result_delete_jobs = mysqli_query($conn, $sql_delete_jobs);

    $sql_delete_applications = "DELETE FROM applicants WHERE user_id = '$user_id'";
    $result_delete_applications = mysqli_query($conn, $sql_delete_applications);


    $sql_delete_company = "DELETE FROM company_detail WHERE user_id = '$user_id'"
    $result_delete_company = mysqli_query($conn, $sql_delete_company);

    if ($result_delete_jobs) {
        if($result_delete_applications){
            if($result_delete_company){
        // Now, delete the user from the userdetail table
        $sql_delete_user = "DELETE FROM userdetail WHERE user_id = '$user_id'";
        $result_delete_user = mysqli_query($conn, $sql_delete_user);

        if ($result_delete_user) {
            echo "User and related job details deleted successfully.";
            header("Refresh:1 ; URL=viewusers.php");
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
            }
            else{
                echo "Error deleting company: " . mysqli_error($conn);
            }
            
        }
        else{
            echo "Error deleting applications. " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting related job details: " . mysqli_error($conn);
    }
}

// Close the database conn
mysqli_close($conn);
?>

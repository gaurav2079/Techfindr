<?php
// Include the database conn configuration
include 'config/dbconnect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $job_id = $_POST['job_id'];
    $company_name = $_POST['companyname'];
    $designation = $_POST['designation'];
    $detail = $_POST['detail'];
    $req1 = $_POST['req1'];
    $req2 = $_POST['req2'];
    $req3 = $_POST['req3'];

    // Update the Job details in the job_detail table
    $sql = "UPDATE job_detail SET company_name = '$company_name', designation = '$designation', detail = '$detail', req1 = '$req1', req2 = '$req2', req3 = '$req3' WHERE job_id = '$job_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Job details updated successfully.";
        header("Refresh:1 ; URL=jobs.php");
    } else {
        echo "Error updating job details: " . mysqli_error($conn);
    }
}

// Close the database conn
mysqli_close($conn);
?>

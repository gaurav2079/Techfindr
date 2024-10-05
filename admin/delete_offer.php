<?php
// Include the database conn configuration
include 'config/dbconnect.php';

// Check if the offer ID is provided as a parameter
if (isset($_GET['id'])) {
    $offer_id = $_GET['id'];

    // Delete the job offer from the job_offers table
    $sql = "DELETE FROM job_offers WHERE id = '$offer_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Job offer deleted successfully.";
        header("Refresh:1 ; URL=view_job_requests.php");
    } else {
        echo "Error deleting job offer: " . mysqli_error($conn);
    }
} else {
    echo "Invalid offer ID.";
}

// Close the database conn
mysqli_close($conn);
?>

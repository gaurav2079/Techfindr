<?php
// search_jobs.php

// Include the database configuration
include_once 'partials/config.php';

// Check if the search term is provided via GET request
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Prepare the SQL query to search for jobs based on the job title
    $query = "SELECT * FROM job_detail WHERE designation LIKE '%$searchTerm%'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if there are any matching results
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results and create HTML for each job
        while ($row = mysqli_fetch_assoc($result)) {
            $companyName = $row['company_name'];
            $designation = $row['designation'];
            $detail = $row['detail'];
            $req1 = $row['req1'];
            $req2 = $row['req2'];
            $req3 = $row['req3'];

            // Create the HTML for each job
            echo '<div class="job-card">';
            echo '<div class="job-name">';
            echo '<img class="job-profile" src="partials/images/' . strtolower($companyName) . '.png">';
            echo '<div class="job-details">';
            echo '<h4>' . $companyName . '</h4>';
            echo '<h3>' . $designation . '</h3>';
            echo '<p>' . $detail . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<div class="job-label">';
            if ($req1) {
                echo '<a class="label-1" href="#">' . $req1 . '</a>';
            }
            if ($req2) {
                echo '<a class="label-2" href="#">' . $req2 . '</a>';
            }
            if ($req3) {
                echo '<a class="label-3" href="#">' . $req3 . '</a>';
            }
            echo '</div>';
            echo '<div class="applynow-btn">';
            echo '<button class="applynow" onclick="location.href=\'applynow.php?id=' . $row['job_id'] . '\'">Apply Now</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        // No matching results found
        echo '<p>No matching jobs found.</p>';
    }
}
?>

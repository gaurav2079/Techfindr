<?php
include_once 'adminHeader.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <h2>Job Details</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Company Name</th>
                    <th>Designation</th>
                    <th>Detail</th>
                    <th>Requirement1</th>
                    <th>Requirement2</th>
                    <th>Requirement3</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection configuration
                include 'config/dbconnect.php';

                // Fetch data from the userdetail table
                $sql = "SELECT * FROM job_detail";
                $result = mysqli_query($conn, $sql);

                // Loop through the fetched data and display it in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['job_id'] . "</td>";
                    echo "<td>" . $row['company_name'] . "</td>";
                    echo "<td>" . $row['designation'] . "</td>";
                    echo "<td>" . $row['detail'] . "</td>";
                    echo "<td>" . $row['req1'] . "</td>";
                    echo "<td>" . $row['req2'] . "</td>";
                    echo "<td>" . $row['req3'] . "</td>";
                    echo "<td>";
                    echo "<a href='editjob.php?id=" . $row['job_id'] . "' class='btn btn-primary mr-2 mb-2'>Edit</a> <br>";
                    
                    echo "<a href='deletejob.php?id=" . $row['job_id'] . "' class='btn btn-danger'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <div class="d-grid gap-2">
  <button class="btn btn-primary" type="button" onclick="location.href='dashboard.php'">Back to Dashboard</button>
  <button class="btn btn-primary" type="button" onclick="location.href='view_job_requests.php'">Add More Job</button>
</div>
    </div>
</body>
</html>

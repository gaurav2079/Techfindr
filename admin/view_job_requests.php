<!DOCTYPE html>
<html>
<head>
    <title>Job Offers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <?php
        include 'adminHeader.php';
    ?>
    <div class="container">
        <h2>Job Offers</h2>
        <?php
        
        // Include the database connection configuration
        include 'config/dbconnect.php';

        // Fetch job offers from the job_offers table
        $sql = "SELECT * FROM job_offers";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Job Title</th>
                            <th>Description</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['company_name'] . '</td>
                        <td>' . $row['job_title'] . '</td>
                        <td>' . $row['description'] . '</td>
                        <td>' . $row['contact_number'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>
                            <a href="delete_offer.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                            <a href="addjobs.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Post Job</a>
                        </td>
                      </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>No job offers found.</p>';
        }

        // Close the database conn
        mysqli_close($conn);
        ?>
         <div class="d-grid gap-2">
  <button class="btn btn-primary" type="button" onclick="location.href='dashboard.php'">Back to Dashboard</button>
</div>
    </div>
    
</body>
</html>

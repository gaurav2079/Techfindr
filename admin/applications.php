<!DOCTYPE html>
<html>
<head>
    <title>Job Applications</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <?php
        include 'adminHeader.php';
    ?>
    <div class="container">
        <h2>Job Applications</h2>
        <?php
        
        // Include the database connection configuration
        include 'config/dbconnect.php';

        // Fetch job applications with company name and job title from the applicants and job_detail tables
        $sql = "SELECT a.applicant_id, a.applicant_name, j.company_name, j.designation, a.contact_number, a.email 
                FROM applicants a
                INNER JOIN job_detail j ON a.job_id = j.job_id";
        
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Company Name</th>
                            <th>Job Title</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['applicant_name'] . '</td>
                        <td>' . $row['company_name'] . '</td>
                        <td>' . $row['designation'] . '</td>
                        <td>' . $row['contact_number'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>
                            <a href="deleteapplication.php?id=' . $row['applicant_id'] . '" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>No job Applications found.</p>';
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

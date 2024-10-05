<!DOCTYPE html>
<html>
<head>
    <title>Job Portal</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Job Applicants</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Cover Letter</th>
                    <th>Resume</th>
                </tr>
            </thead>
            <tbody>

        

                <?php
                // Include the database configuration file
                include 'partials/config.php';

                if (isset($_GET['id'])) {
                    $jobID = $_GET['id'];    
                } 

                // Fetch applicants data from the database
                $query = "SELECT * FROM applicants where job_id = $jobID";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['applicant_name'];
                    $email = $row['email'];
                    $contactNumber = $row['contact_number'];
                    $resumePath = $row['resume'];
                    $cover_letter = $row['cover_letter'];

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$email</td>";
                    echo "<td>$contactNumber</td>";
                    echo "<td>$cover_letter</td>";
                    echo "<td><a href='$resumePath' target='_blank'>Download</a></td>";
                    echo "</tr>";
                }
                // else{
                //     echo '<p>No job offers found.</p>';
                // }

                

                ?>
            </tbody>
        </table>
    </div>
    <button class="btn btn-primary m-5" type="button" onclick="location.href='index.php'">Back to Home</button>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

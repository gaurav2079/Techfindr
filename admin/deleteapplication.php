<!DOCTYPE html>
<html>
<head>
    <title>Delete Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Delete Application</h2>
        <?php
        // Include the database connection configuration
        include 'config/dbconnect.php';

        // Check if the user ID is provided in the URL
        if (isset($_GET['id'])) {
            $applicant_id = $_GET['id'];

            // Fetch user data from the userdetail table
            $sql = "SELECT * FROM applicants WHERE applicant_id = '$applicant_id'";
            $result = mysqli_query($conn, $sql);

            // Check if the user exists
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Display the job details and delete confirmation
                ?>
                <p>Are you sure you want to delete the following Application?</p>
                <p><strong>Applicant Name:</strong> <?php echo $row['applicant_name']; ?></p>
                <form method="POST" action="confirm_delete_applicant.php">
                    <input type="hidden" name="applicant_id" value="<?php echo $row['applicant_id']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <?php
            } else {
                echo "Applicant not found.";
            }
        } 
        else {
            echo "Invalid Applicant ID.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

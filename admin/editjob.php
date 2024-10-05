<!DOCTYPE html>
<html>
<head>
    <title>Edit Job</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Job</h2>
        <?php
        // Include the database connection configuration
        include 'config/dbconnect.php';

        // Check if the user ID is provided in the URL
        if (isset($_GET['id'])) {
            $job_id = $_GET['id'];

            // Fetch user data from the userdetail table
            $sql = "SELECT * FROM job_detail WHERE job_id = '$job_id'";
            $result = mysqli_query($conn, $sql);

            // Check if the user exists
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Display the form with the user details
                ?>
                <form method="POST" action="update_job.php">
                    <div class="form-group">
                        <label for="companyname">Job Name</label>
                        <input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $row['company_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $row['designation']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <input type="detail" class="form-control" id="detail" name="detail" value="<?php echo $row['detail']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="req1">Requirement1</label>
                        <input type="text" class="form-control" id="req1" name="req1" value="<?php echo $row['req1']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="req2">Requirement2</label>
                        <input type="text" class="form-control" id="req2" name="req2" value="<?php echo $row['req2']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="req3">Requirement3</label>
                        <input type="text" class="form-control" id="req3" name="req3" value="<?php echo $row['req3']; ?>" required>
                    </div>
                    <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <?php
            } else {
                echo "Job not found.";
            }
        } else {
            echo "Invalid Job ID.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

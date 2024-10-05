<?php
include 'config/dbconnect.php';
session_start();

// Fetch job offer from the job_offers table


if (isset($_GET['id'])) {
    $getsql = "SELECT * FROM job_offers WHERE id = '{$_GET['id']}'";
    $results = mysqli_query($conn, $getsql);

    if (!$results) {
        die("Error fetching data: " . mysqli_error($conn));
    }




    // Check if the data is available and display the form
    if (mysqli_num_rows($results) > 0) {
        $row = mysqli_fetch_assoc($results);

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get form data
            $designation = $_POST['designation'];
            $company_name = $_POST['name'];
            $detail = $_POST['description'];
            $req1 = $_POST['requirement1'];
            $req2 = $_POST['requirement2'];
            $req3 = $_POST['requirement3'];
            $user_id = $row['user_id'];

            // Insert data into the job_detail table
            $insertSql = "INSERT INTO job_detail (user_id, company_name, designation, detail, req1, req2, req3) 
                          VALUES ('$user_id', '$company_name', '$designation', '$detail', '$req1', '$req2', '$req3')";

            $insertResult = mysqli_query($conn, $insertSql);

            if ($insertResult) {
                echo "<script>alert('Job Added Successfully.');</script>";
                header("location: jobs.php");
                $delsql = "delete from job_offers where id = '{$_GET['id']}'";
                $delresult = mysqli_query($conn, $delsql);
                exit();
            } else {
                echo "Insertion failed: " . mysqli_error($conn);
            }
        }






    




        // Display the form
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Add Company Details</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">
                <h2>Add Company Details</h2>
                <form method="post" enctype="multipart/form-data" action="">
                    <!-- <div class="form-group">
                        <label for="logo">Logo:</label>
                        <input type="file" class="form-control-file" id="logo" name="logo">
                    </div> -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter company name" value="<?php echo $row['company_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation:</label>
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" value="<?php echo $row['job_title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter company description"><?php echo $row['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="requirement1">Requirement 1:</label>
                        <input type="text" class="form-control" id="requirement1" name="requirement1" placeholder="Enter job requirement 1" value="<?php echo $row['req1']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="requirement2">Requirement 2:</label>
                        <input type="text" class="form-control" id="requirement2" name="requirement2" placeholder="Enter job requirement 2" value="<?php echo $row['req2']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="requirement3">Requirement 3:</label>
                        <input type="text" class="form-control" id="requirement3" name="requirement3" placeholder="Enter job requirement 3" value="<?php echo $row['req3']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo '<p>No job offer found for the given ID.</p>';
    }
}
?>

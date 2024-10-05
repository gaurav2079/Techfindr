<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <?php
        // Include the database connection configuration
        include 'config/dbconnect.php';

        // Check if the user ID is provided in the URL
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];

            // Fetch user data from the userdetail table
            $sql = "SELECT * FROM userdetail WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);

            // Check if the user exists
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Display the form with the user details
                ?>
                <form method="POST" action="update_user.php">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $row['contact_number']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <input type="text" class="form-control" id="user_type" name="user_type" value="<?php echo $row['user_type']; ?>" required>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <?php
            } else {
                echo "User not found.";
            }
        } else {
            echo "Invalid user ID.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

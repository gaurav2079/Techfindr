<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Delete User</h2>
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
                // Display the user details and delete confirmation
                ?>
                <p>Are you sure you want to delete the following user?</p>
                <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
                <p><strong>Contact Number:</strong> <?php echo $row['contact_number']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>User Type:</strong> <?php echo $row['user_type']; ?></p>
                <form method="POST" action="confirm_delete_user.php">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
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

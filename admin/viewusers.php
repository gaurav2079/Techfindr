<?php
include_once 'adminHeader.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <h2>User Details</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection configuration
                include 'config/dbconnect.php';

                // Fetch data from the userdetail table
                $sql = "SELECT * FROM userdetail";
                $result = mysqli_query($conn, $sql);

                // Loop through the fetched data and display it in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['contact_number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['user_type'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_user.php?id=" . $row['user_id'] . "' class='btn btn-primary mr-2'>Edit</a>";
                    
                    echo "<a href='delete_user.php?id=" . $row['user_id'] . "' class='btn btn-danger'>Delete</a>";
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
</div>
    </div>
</body>
</html>

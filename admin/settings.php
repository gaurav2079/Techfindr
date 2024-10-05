<?php

include_once 'adminHeader.php';

require_once 'config/dbconnect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminname = $_POST['adminname'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE admin_detail SET admin_name = '$adminname', admin_password = '$hashed_password' WHERE admin_name = '$adminname'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Admin details updated successfully.";
        $_SESSION["adminname"] = $adminname;
        header("Refresh:1 ; URL=index.php");
    } else {
        echo "Error updating user details: " . mysqli_error($conn);
    }
}
?>






<!DOCTYPE html>
<html>
<head>
  <title>Change Admin Detail</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .center-form {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 70vh;
    }
  </style>
</head>
<body>

  <div class="container center-form">
    <div class="col-md-6">
      <h2>Change Admin Detail</h2>
      <form method="post" action="">
        <div class="form-group">
          <label for="adminname">Admin Name:</label>
          <input type="text" class="form-control" id="adminname" name="adminname" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-primary" onclick="location.href='dashboard.php'">Cancel</button>
      </form>
    </div>
  </div>
</body>
</html>

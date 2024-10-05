
<?php
include 'config/dbconnect.php';
session_start();
// $stmt = mysqli_prepare($conn, $sql);
// if ($stmt)
// {

    // Set these parameters
    // $image = $_FILES['image']['name'];
    if(isset($_POST['submit'])){

    
    $designation = $_POST['designation'];
    $company_name = $_POST['name'];
    $detail = $_POST['description'];
    $req1 = $_POST['requirement1'];
	  $req2 = $_POST['requirement2'];
    $req3 = $_POST['requirement3'];
    $sql = "INSERT INTO job_detail(company_name, designation, detail, req1, req2, req3) VALUES ('$company_name','$designation','$detail','$req1','$req2','$req3')";

    // Execute the prepared statement
    $result = mysqli_query($conn, $sql);
    if($result){
      echo "insertion successful";
      header("location:addjobs.php");
    }
    else{
      echo "insertion failed";
      header("location:addjobs.php");
    }
    // if (mysqli_stmt_bind_param($stmt, "ssssss", $company_name, $designation, $detail, $req1, $req2, $req3))
    // {
    // if (mysqli_stmt_execute($stmt))
    // {
    //   header('Location: addjobs.php');

    //   }
    //   }
    //   }

     }
?>





<!DOCTYPE html>
<html>
<head>
  <title>Add Company </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Add Company </h2>
    <form method = "POST" enctype="multipart/form-data" action="">
      <div class="form-group">
        <label for="logo">Logo:</label>
        <input type="file" class="form-control-file" id="logo" name="logo">
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter company name">
      </div>


      <div class="form-group">
        <label for="designation">Designation:</label>
        <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter company description"></textarea>
      </div>
      <div class="form-group">
        <label for="requirement1">Requirement 1:</label>
        <input type="text" class="form-control" id="requirement1" name="requirement1" placeholder="Enter job requirement 1">
      </div>
      <div class="form-group">
        <label for="requirement2">Requirement 2:</label>
        <input type="text" class="form-control" id="requirement2" name="requirement2" placeholder="Enter job requirement 2">
      </div>
      <div class="form-group">
        <label for="requirement3">Requirement 3:</label>
        <input type="text" class="form-control" id="requirement3" name="requirement3" placeholder="Enter job requirement 3">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

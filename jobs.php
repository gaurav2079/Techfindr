<?php
            include_once 'partials/config.php';
            $sql = "SELECT * FROM job_detail";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
        ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="partials/style.css">
    <title>Jobs</title>
    <?php
include_once 'partials/header.php';
?>
<div class="image">
    <img src="partials/images/jobbanner.png" class="image" alt="...">
</div>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>   
        <?php
            include 'jobslisting.php';
        ?>
    <?php
    include 'partials/footer.php';
    ?>
</body>
</html>

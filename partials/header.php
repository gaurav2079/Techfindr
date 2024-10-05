<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="partials/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="partials/hstyles.css">

    <!-- <title>Header</title>

</head>
<body> -->
    
    <nav class="navbar">
        <h2 class="navbar-logo"><a href="index.php">TechFindr</a></h2>
        <div class="navbar-menu">
            <a href="index.php">Home</a>
            <a href="jobs.php">Jobs</a>
            <!-- <a href="companies.php">Companies</a> -->
            <?php 
            session_start();
            $isSignedIn = isset($_SESSION['username']);
            if ($isSignedIn)
            {
                echo "<a href='postjob.php'>Offer a Job</a>";
                echo "<a href='myjobs.php'>My Jobs</a>";
                echo "<a href='signout.php'>Sign Out</a>";
            }
            else{
                echo "<a href='login.php'>Sign In</a>";
            }
            ?>
            
        </div>
    </nav>
<!-- </body>
</html> -->

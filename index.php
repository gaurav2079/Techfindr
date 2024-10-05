<?php
            include_once 'partials/config.php';
            $sql = "SELECT * FROM job_detail";
            $sql2 = "SELECT logo from company_detail";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_num_rows($result2);
        ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="partials/style.css">


<!-- Add this code in the <head> section of your HTML file or at the end of the body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Function to handle the search
    function handleSearch() {
        var searchTerm = $(".search-input").val().trim();
        if (searchTerm !== "") {
            // Send AJAX request to the server
            $.ajax({
                url: "search_jobs.php", // Replace with the actual PHP file to handle the search on the server
                type: "GET",
                data: { search: searchTerm },
                dataType: "html",
                success: function(data) {
                    // Update the job list section with the search results
                    $("#jobs").html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error: " + textStatus, errorThrown);
                }
            });
        }
    }

    // Attach click event handler to the search button
    $(".search-button").click(function(event) {
        event.preventDefault();
        handleSearch();
    });

    // Attach keyup event handler to the search input to perform real-time search as the user types
    $(".search-input").keyup(function() {
        handleSearch();
    });
});
</script>



    <title>Home-TechFindr</title>
</head>
<body>
<?php
include_once 'partials/header.php';
?>  

<div class="image">
    <img src="partials/images/banner.png" class="image" alt="...">
</div>
<div class="search">
        <div class="search-box">
            <div class="search-card">
            <input class="search-input" type="text" placeholder="">
                <button class="search-button">Search</button>
            </div>
        </div>
    </div>

    
    







<section class="job-list" id="jobs">
<h1 class="section-title">Featured Jobs</h1>




    <?php
    $query = "SELECT job_id, company_name, designation, detail, req1, req2, req3 FROM job_detail limit 3";
    $result = mysqli_query($conn, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $companyName = $row['company_name'];
        $designation = $row['designation'];
        $detail = $row['detail'];
        $req1 = $row['req1'];
        $req2 = $row['req2'];
        $req3 = $row['req3'];
    ?>
        <div class="job-card">
            <div class="job-name">
                <img class="job-profile" src="partials/images/<?php echo strtolower($companyName); ?>.png">
                <div class="job-details">
                    <h4><?php echo $companyName; ?></h4>
                    <h3><?php echo $designation; ?></h3>
                    <p><?php echo $detail; ?></p>
                </div>
            </div>
            <div class="job-label">
                <?php if ($req1) { ?><a class="label-1" href="#"><?php echo $req1; ?></a><?php } ?>
                <?php if ($req2) { ?><a class="label-2" href="#"><?php echo $req2; ?></a><?php } ?>
                <?php if ($req3) { ?><a class="label-3" href="#"><?php echo $req3; ?></a><?php } ?>
            </div>

            <div class="applynow-btn">
                <button class="applynow" onclick="location.href='applynow.php?id=<?php echo $row['job_id']; ?>'">Apply Now</button>
            </div>

            <!-- <div class="appview-btn">
                <button class="appview" onclick="location.href='viewapplications.php?id=
                <?php 
                // echo $row['job_id']; 
                ?>'">View Applications</button>
            </div> -->
        </div>
    <?php
    }
    ?>
</section>

            

        <button class="more-job" onclick="location.href='jobs.php'">List more Jobs</button>
<?php
include 'companies.php';
include_once 'partials/footer.php';
?>

</body>
</html>

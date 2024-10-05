


<section class="job-list" id="jobs">
<h1 class="section-title">Featured Jobs</h1>




    <?php
    $query = "SELECT job_id, company_name, designation, detail, req1, req2, req3 FROM job_detail";
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
                ?>
                '">View Applications</button>
            </div> -->
        </div>
    <?php
    }
    ?>
</section>

            
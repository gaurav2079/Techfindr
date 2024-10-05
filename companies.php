
    <section class="join">
        <div class="join-detail">
            <h1 class="section-title">GET READY TO IMPROVE YOURSELF WITH US</h1>
            <p> Our company will provide you with the better opportunities to you and make you better in your work.</p>
        </div>
        <button class="join-button" onclick="location.href='register.php'">Join Now</button>
    </section>

    <section class="featured" id="companies">
    <h1 class="section-title">Featured Companies</h1>
    <div class="featured-wrapper">
        <?php
        $query = "SELECT DISTINCT company_name FROM job_detail";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $companyName = $row['company_name'];
        ?>
            <div class="featured-card">
                <img class="featured-image" src="partials/images/<?php echo strtolower($companyName); ?>.png">
                <p><?php echo $companyName; ?></p>
            </div>
        <?php
        }
        mysqli_close($conn);
        ?>
    </div>
</section>



    
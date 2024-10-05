
    <section class="m-5">

<h3 class="text-center" style="color:maroon;">Featured Jobs</h3>
<div class="container">
    <div class="row">

    <?php

if($row>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
       
        ?>
            <div class="col-md-3 pb-3">
                <img src="<?php echo $row["logo"]; ?>" style="width:100%; height: 250px;">
                <h6 class="text-center" style="height:40px;"><?php echo $row["company_name"]; ?></h6>
                <p><b>Designation: </b> <?php echo $row["designation"]; ?></p>
                <p><b>Detail :</b> <?php echo $row["detail"]; ?></p>
                <p><b>Requirement1 :</b><?php echo $row["req1"]; ?></p>
                <p><b>Requirement2 :</b> <?php echo $row["req2"]; ?></p>
                <p><b>Requirement3 :</b> <?php echo $row["req3"]; ?></p>
                <a  class="btn" style="background-color:maroon; color:white; width:100%;"href="applynow.php">Apply Now</a>
                <br><br>
                <a  class="btn" style="background-color:maroon; color:white; width:100%;"href="viewapplications.php">View Applications</a>


            </div>
        <?php

    }
}

?>

</div>
</div>
</section>
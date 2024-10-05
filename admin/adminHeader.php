<?php
   
   include_once "./config/dbconnect.php";

?>
       
 <!-- nav -->
 <nav  class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #1e2024;">
    
    <a class="navbar-brand ml-5" href="./index.php">
        <img src="./assets/images/logo.png" width="10%" height="auto" alt="TechFindr">
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
    <div class="user-cart">  
        <?php           
        if(!isset($_SESSION['adminname'])){
          ?>
          <a href="index.php" style="text-decoration:none;">
            <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
         </a>
          <?php
        } 
        else {
            ?>
            <a href="logout.php" style="text-decoration:none;">
                    <i class="fa fa-sign-out mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
            </a>

            <?php
        } ?>
    </div>  
</nav>

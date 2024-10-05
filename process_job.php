<?php
session_start();
include 'partials/errorreporting.php';
include 'partials/config.php';

if (isset($_GET['id'])) {
    $userID = $_GET['id'];   
    $user_id = mysqli_real_escape_string($conn, $_SESSION["id"]);
}

// Retrieve the form data
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
$company_name =$_POST['company_name'];
$job_title = $_POST['job_title'];
$description = $_POST['description'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$requirements = $_POST['requirements'];


 
if (isset($_FILES["logo"]["error"]) && ($_FILES["logo"]["error"] == 0) ){
    $allowedTypes = ["image/png"];
    $maxFileSize = 1048576; // 1MB

    $fileType = $_FILES["logo"]["type"];
    $fileSize = $_FILES["logo"]["size"];

    if (in_array($fileType, $allowedTypes)) {
        if ($fileSize <= $maxFileSize) {
            $uploadDir = "partials/images/";

            $filename = strtolower($company_name) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
            $destination = $uploadDir . $filename;

            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $destination)) {
                $sql = "INSERT INTO job_offers (user_id, company_name, job_title, description, contact_number, email, req1, req2, req3)
                VALUES ('$user_id', '$company_name', '$job_title', '$description', '$contact_number', '$email', '$requirements[0]', '$requirements[1]', '$requirements[2]')";

                $sql2 = "INSERT INTO company_detail (user_id, company_name, logo, contact_number, email)
                VALUES ('$user_id', '$company_name', '$destination', '$contact_number', '$email')";

                if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
                    echo "Job posting requested successfully.";
                    header("Refresh:2; URL=index.php");
                } else {
                    echo "Error posting job: " . mysqli_error($conn);
                }
            } else {
                echo 'Error: Failed to move uploaded file.';
            }
        } else {
            echo "Failed to upload the file. File size exceeds the maximum limit (1MB).";
        }
    } else {
        echo "Invalid file type. Only jpg, png, and jpeg files are allowed.";
    }
} else {
    echo "Error occurred during file upload.";
}

// Close the database connection
mysqli_close($conn);
// }



// Insert the job details into the jobs table
// $sql = "INSERT INTO job_offers (company_name, job_title, description, contact_number, email, req1, req2, req3)
//         VALUES ('$company_name', '$job_title', '$description', '$contact_number', '$email', '$requirements[0]', '$requirements[1]', '$requirements[2]')";

// $sql2 = "INSERT INTO company_detail (company_name, contact_number, email
// ) VALUES ('$company_name', '$contact_number', '$email')";


// if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) ) {
//     echo "Job posting requested successfully.";
//     header("Refresh:2 ; URL=index.php");
// } else {
//     echo "Error posting job: " . mysqli_error($conn);
// }

// // Close the database conn
// mysqli_close($conn);
?>

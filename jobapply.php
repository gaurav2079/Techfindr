<?php
include 'partials/errorreporting.php';
include 'partials/config.php';


if (isset($_GET['id'])) {
    $jobID = $_GET['id'];
}

$user_id = mysqli_real_escape_string($conn, $_SESSION["id"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contact_number'];
    $coverletter = $_POST['cover_letter'];

    // Check if the user is the owner of the job listing
    $isOwner = checkIfUserIsOwner($user_id, $jobID);

    if ($isOwner) {
        // Display an error message indicating that the user cannot apply for their own job
        echo "<h1> You cannot apply for your own job.</h1>";
                header("Refresh:1 ; URL=jobs.php");
    } else {
        if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
            $allowedTypes = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
            $maxFileSize = 1048576; // 1MB

            $fileType = $_FILES["resume"]["type"];
            $fileSize = $_FILES["resume"]["size"];

            if (in_array($fileType, $allowedTypes)) {
                if ($fileSize <= $maxFileSize) {
                    $uploadDir = "partials/images/";

                    $filename = uniqid("resume_", true) . "." . pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION);
                    $destination = $uploadDir . $filename;

                    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $destination)) {
                        // Prepare the INSERT statement
                        $stmt = mysqli_prepare($conn, "INSERT INTO applicants (user_id, job_id, applicant_name, contact_number, email, cover_letter, resume) VALUES (?, ?, ?, ?, ?, ?, ?)");

                        // Bind the parameters and execute the statement
                        mysqli_stmt_bind_param($stmt, "iisssss", $user_id, $jobID, $name, $contactNumber, $email, $coverletter, $destination);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "Application submitted successfully!";
                            header("Refresh:1 ; URL=index.php");
                        } else {
                            echo "Error: Failed to submit the application.";
                        }
                    } else {
                        echo "Failed to upload the file.";
                    }
                } else {
                    echo "File size exceeds the maximum limit (1MB).";
                }
            } else {
                echo "Invalid file type. Only PDF, DOC, and DOCX files are allowed.";
            }
        } else {
            echo "Error occurred during file upload.";
        }
    }
}

// Function to check if the user is the owner of the job listing
function checkIfUserIsOwner($user_id, $job_id) {
    global $conn;
    $query = "SELECT user_id FROM job_detail WHERE job_id = ?";

    // Prepare and execute the query
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $job_id);
    mysqli_stmt_execute($stmt);

    // Bind the result
    mysqli_stmt_bind_result($stmt, $owner_id);

    // Fetch the result
    if (mysqli_stmt_fetch($stmt)) {
        // Compare the owner's user ID with the current user's user ID
        return $owner_id == $user_id;
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    return false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="applystyles.css">
</head>

<body>
    <div class="container">
        <h2>Job Application</h2>

        <form enctype="multipart/form-data" id="applyForm" method="POST" action="">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="name" placeholder="Enter your full name" required>
                <span id="fullName_err" class="error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                    required>
                <span id="email_err" class="error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number</label>
                <input type="tel" class="form-control" id="contactNumber" name="contact_number"
                    placeholder="Enter your contact number" required>
                <span id="contactNumber_err" class="error" style="color:red"></span>
            </div>

            <div class="form-group">
                <label for="resume">Resume</label>
                <div class="custom-file">
                    <label class="custom-file-label" for="resume">Choose file</label>
                    <input type="file" class="custom-file-input" id="resume" name="resume" required>
                    <?php
                    if (isset($err['resume'])) {
                        echo $err['resume'];
                    }
                    ?>

                </div>
            </div>

            <script>
    document.getElementById('resume').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.innerText = fileName;
    });
</script>

            <div class="form-group">
                <label for="coverLetter">Cover Letter</label>
                <textarea class="form-control" id="coverLetter" name="cover_letter" rows="5"
                    placeholder="Enter your cover letter" required></textarea>
                <span id="coverLetter_err" class="error" style="color:red"></span>
            </div>

            <br>
            <center>
            <button type="submit" id="submitButton" class="btn btn-primary" >Submit Application</button>
            <br><br>
            </center> 
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="module">
    // Function to validate the Contact Number field
    function validateContactNumber(number) {
        var numberRegex = /^\d{10}$/;
        return numberRegex.test(number);
    }

    // Function to validate the Email field
    function validateEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Function to validate the Company Name, Description, and Requirements fields
    function validateTextWithNoNumber(text) {
        var textRegex = /^[a-zA-Z][a-zA-Z0-9\s]*$/;
        return textRegex.test(text);
    }

    // Function to check if all error fields are empty
    function areErrorFieldsEmpty() {
        return (
            $("#fullName_err").text() === "" &&
            $("#email_err").text() === "" &&
            $("#contactNumber_err").text() === "" &&
            $("#coverLetter_err").text() === ""
        );
    }

    // Function to enable or disable the Submit Button based on error fields
    function updateSubmitButtonState() {
        var submitButton = $("#submitButton");
        if (areErrorFieldsEmpty()) {
            submitButton.removeAttr("disabled");
        } else {
            submitButton.attr("disabled", "disabled");
        }
    }

    // Function to perform real-time validation for each field on key press
    $(document).ready(function () {
        // Company Name validation
        $("#fullName").on("keyup", function () {
            var fullName = $(this).val();
            var errorSpan = $("#fullName_err");
            if (validateTextWithNoNumber(fullName)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Full Name should not begin with a number.");
            }
            updateSubmitButtonState(); // Update Submit Button state
        });

        // Email validation
        $("#email").on("keyup", function () {
            var email = $(this).val();
            var errorSpan = $("#email_err");
            if (validateEmail(email)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Invalid Email.");
            }
            updateSubmitButtonState(); // Update Submit Button state
        });

        // Contact Number validation
        $("#contactNumber").on("keyup", function () {
            var contactNumber = $(this).val();
            var errorSpan = $("#contactNumber_err");
            if (validateContactNumber(contactNumber)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Invalid Contact Number. Please enter 10 digits.");
            }
            updateSubmitButtonState(); // Update Submit Button state
        });

        // Cover Letter validation
        $("#coverLetter").on("keyup", function () {
            var coverLetter = $(this).val();
            var errorSpan = $("#coverLetter_err");
            if (coverLetter.trim() !== "") {
                errorSpan.text("");
            } else {
                errorSpan.text("Cover Letter is required.");
            }
            updateSubmitButtonState(); // Update Submit Button state
        });

        // Display the selected file name for the resume
        $("#resume").on("change", function (e) {
            var fileName = e.target.files[0].name;
            var label = document.querySelector(".custom-file-label");
            label.innerText = fileName;
        });

        // Initial state setup
        updateSubmitButtonState();
    });
</script>


</body>

</html>

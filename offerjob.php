<!DOCTYPE html>
<html>
<head>
    <title>Post a Job</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
    body {
        background: aqua;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .custom-form {
        max-width: 930px; 
        padding: 20px;
        margin-top: 20px; 
        margin-left: 170px;
    }
</style>
</head>
<body>
<div class="container">
        <div class="custom-form">
            <h2 class="text-center">Post a Job</h2>
            <form method="POST" enctype="multipart/form-data" action="process_job.php?id=<?php echo $row['user_id']; ?>" onsubmit="return validateForm()">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                        <span id="company_name_err" class="error" style="color:red;"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="logo">Company Logo</label>
                        <div class="custom-file">
                            <label class="custom-file-label" for="logo">Choose a logo (only png file is allowed.)</label>
                            <input type="file" class="custom-file-input" id="logo" name="logo" required>
                            <span id="logo_err" class="error" style="color:red;"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="job_title">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" required>
                    <span id="title_err" class="error" style="color:red;"></span>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                        <span id="number_err" class="error" style="color:red;"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <span id="email_err" class="error" style="color:red;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    <span id="description_err" class="error" style="color:red;"></span>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="requirement1">Requirement 1</label>
                        <input type="text" class="form-control" id="requirement1" name="requirements[]" required>
                        <span id="req_err" class="error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="requirement2">Requirement 2</label>
                        <input type="text" class="form-control" id="requirement2" name="requirements[]" required>
                        <span id="req_err" class="error" style="color:red;"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="requirement3">Requirement 3</label>
                        <input type="text" class="form-control" id="requirement3" name="requirements[]" required>
                        <span id="req_err" class="error" style="color:red;"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Post Job</button>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module">
     // Function to validate the Contact Number field
     function validateContactNumber(number) {
        var numberRegex = /^(98|97)\d{8}$/;
        return numberRegex.test(number);
    }

    // Function to validate the Email field
    function validateEmail(email) {
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    // Function to validate the Company Name, Description, and Requirements fields
    function validateTextWithNoNumber(text) {
        var textRegex = /^[a-zA-Z][a-zA-Z0-9\s!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
        return textRegex.test(text);
    }

    // Function to perform real-time validation for each field on key press
    $(document).ready(function() {
        // Company Name validation
        $("#company_name").on("keyup", function() {
            var companyName = $(this).val();
            var errorSpan = $("#company_name_err");
            if (validateTextWithNoNumber(companyName)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Company Name should not begin with a number.");
            }
        });

         // Job Title validation
         $("#job_title").on("keyup", function() {
            var jobtitle = $(this).val();
            var errorSpan = $("#title_err");
            if (validateTextWithNoNumber(jobtitle)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Job Title should not begin with a number.");
            }
        });



        // Description validation
        $("#description").on("keyup", function() {
            var description = $(this).val();
            var errorSpan = $("#description_err");
            if (validateTextWithNoNumber(description)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Description should not begin with a number.");
            }
        });

        // Contact Number validation
        $("#contact_number").on("keyup", function() {
            var contactNumber = $(this).val();
            var errorSpan = $("#number_err");
            if (validateContactNumber(contactNumber)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Invalid Contact Number. Please enter 10 digits.");
            }
        });

        // Email validation
        $("#email").on("keyup", function() {
            var email = $(this).val();
            var errorSpan = $("#email_err");
            if (validateEmail(email)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Invalid Email.");
            }
        });

        // Requirements validation
        $("#requirement1, #requirement2, #requirement3").on("keyup", function() {
            var requirement = $(this).val();
            var errorSpan = $(this).next("#req_err");
            if (validateTextWithNoNumber(requirement)) {
                errorSpan.text("");
            } else {
                errorSpan.text("Requirement should not begin with a number.");
            }
        });

        // Add other real-time validation event listeners for other form fields...

        // Display the selected file name for the logo
        $("#logo").on("change", function(e) {
            var fileName = e.target.files[0].name;
            var label = document.querySelector('.custom-file-label');
            label.innerText = fileName;
        });
    });
    </script>
</body>
</html>

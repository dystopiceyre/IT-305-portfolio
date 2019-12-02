<?php
include "errors.php";

//Regex values to validate certain conventions and patterns for inputs in regards to name, text, linkedIn URL, and email
$nameRegex = "/^([a-zA-Z' -]+)$/";
$basicTextRegex = "/^([a-zA-Z0-9'\", .()\r\n&!?-]+)$/";
$linkedInRegex = "((https:\/\/www.linkedin.com\/in))";
$emailRegex = "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i";

if (!empty($_POST)) {
    require "guestbookDBcnx.php";
    /*----CHECKING CONNECTION FIRST----*/
    if ($cnxn) {
        $isValid = true;
        /*----Begin Validation----*/
        //Validate first name
        if (!empty($_POST['firstName']) AND preg_match($nameRegex, trim($_POST['firstName']))) {
            $fName = ucfirst(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["firstName"]))));
        } else {
            echo '<p>Please enter a valid first name.</p>';
            $isValid = false;
        }
        //Validate last name
        if (!empty($_POST['lastName']) AND preg_match($nameRegex, trim($_POST['lastName']))) {
            $lName = ucfirst(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["lastName"]))));
        } else {
            echo '<p>Please enter a valid last name.</p>';
            $isValid = false;
        }

        //Validate email
        if (!empty($_POST["email"]) AND !preg_match($emailRegex, trim($_POST['email']))) {
            echo '<p>Please provide a valid email.</p>';
            $isValid = false;
        } elseif (isset($_POST['add-me']) AND empty($_POST['email'])) {
            echo '<p>You must provide an email address if you signed up for the mailing list</p>';
            $isValid = false;
        } else {
            $email = mysqli_real_escape_string($cnxn, trim($_POST['email']));
        }
        if (empty($_POST['email'])) {
            $email = "";
        }

        //Validate company
        if (!empty($_POST['company'])) {
            $company = mysqli_real_escape_string($cnxn, trim($_POST['company']));
        } else {
            $company = "";
        }

        //Validate title
        if (!empty($_POST['title'])) {
            $title = mysqli_real_escape_string($cnxn, trim($_POST['title']));
        } else {
            $title = "";
        }

        //Validate linkedIn
        if (!empty($_POST['linkedin']) AND !preg_match($linkedInRegex, trim($_POST['linkedin']))) {
            echo '<p>Please provide a valid LinkedIn URL (Must start with https://).';
            $isValid = false;
        } else {
            $linkedIn = mysqli_real_escape_string($cnxn, trim($_POST['linkedin']));
        }
        if (empty($_POST['linkedin'])) {
            $linkedIn = "";
        }

        //Validate message
        if (!empty($_POST['message']) AND !preg_match($basicTextRegex, trim($_POST['message']))) {
            echo '<p>Please enter a valid message with only alphanumeric characters and basic punctuation</p>';
            $isValid = false;
        } else {
            $message = mysqli_real_escape_string($cnxn, trim($_POST['message']));
        }
        if (empty($_POST['message'])) {
            $message = "";
        }

        //Add to mailing list?
        if (isset($_POST['add-me'])) {
            $addToEmail = (mysqli_real_escape_string($cnxn, TRUE));
        } else {
            $addToEmail = (mysqli_real_escape_string($cnxn, FALSE));
        }

        //validate how did we meet section
        if (isset($_POST["meet"])) {
            if ($_POST["meet"] != "meetup" AND $_POST["meet"] != "job-fair" AND
                $_POST["meet"] != "print" AND $_POST["meet"] != "sponsor" AND
                $_POST["meet"] != "other" AND $_POST["meet"] != "havent") {
                echo '<p>Please provide valid input for how you heard about us.</p>';
                $isValid = false;
            } elseif ($_POST["meet"] == "other") {
                if (empty($_POST["if-other"])) {
                    echo '<p>Please specify how you heard about us.</p>';
                    $isValid = false;
                } else {
                    $howMet = mysqli_real_escape_string($cnxn, ucfirst(trim($_POST["if-other"])));
                }
            } else {
                $howMet = ucfirst($_POST["meet"]);
            }

            $date = date_create();
            $timestamp = date_timestamp_get($date);

            /*-----End Validation-----*/
        } else {
            echo "<h3>Connection Failed!</h3>";
            echo "<p>Please go back and resubmit.</p>";
        }
//All input is valid and ready for database insertion
        if ($isValid) {
            /*------SQL Insertion-------*/

            $insertSQL = "INSERT INTO guestbook (timestamp, name, email, title, company, linkedIn, message, mailingList, howMet) VALUES 
                                    ('$timestamp', '$fName $lName', '$email', '$title', '$company', '$linkedIn', '$message', '$addToEmail', '$howMet')";
            $result = mysqli_query($cnxn, $insertSQL);
            if ($result) {
                if ($addToEmail) {
                    $onList = "yes";
                } else {
                    $onList = "no";
                }

                /*--------------Confirmation page display-----------*/
                echo "<h1>Guestbook Submission Confirmation</h1>
                <p> Thanks for signing my guestbook!</p>
                </div>";
                /*----DISPLAY SUBMITTED INFO BACK TO APPLICANT----*/
                echo "<div class='container'>";
                echo "<span><strong>Name: </strong>$fName $lName</span><br>";
                if ($email != "") {
                    echo "<span><strong>Email: </strong>$email</span><br>";
                }
                if ($title != "") {
                    echo "<span><strong>Title: </strong>$title</span><br>";
                }
                if ($company != "") {
                    echo "<span><strong>Company: </strong>$company</span><br>";
                }
                if ($linkedIn != "") {
                    echo "<span><strong>LinkedIn: </strong>$linkedIn</span><br>";
                }
                if ($message != "") {
                    echo "<span><strong>Message: </strong>$message</span><br>";
                }
                echo "<span><strong>Add to mailing list: </strong>$onList</span><br>";
                echo "<span><strong>How we met: </strong>$howMet</span><br>";
                echo "</div>";

            }

        } else {
            echo mysqli_error($cnxn);
            echo "<p>Something went wrong. Please try again!</p>";
            echo "<p>Try again.</p>";
        }
    }
}
?>
</body>
</html>
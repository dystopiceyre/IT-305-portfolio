
<?php
    $sid = $_POST['sid'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthdate = $_POST['birthdate'];
    $gpa = $_POST['gpa'];
    $advisor = $_POST['advisor'];

    echo "<p>SID: $sid</p>
    <p>First Name: $firstName</p>
    <p>Last Name: $lastName</p>
    <p>Birthdate: $birthdate</p>
    <p>GPA: $gpa</p>
    <p>Advisor: $advisor</p>";
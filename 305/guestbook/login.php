<?php
session_start();
include "errors.php";

//if already logged in, redirect to admin page
if (isset($_SESSION['username']) && $_SESSION['loggedin'] === true) {
    header("location: admin.php");
    exit;
}

include "creds.php";

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

//If the username and password are correct
    if ($username == $adminusername && $password == $adminpassword) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        header("location: admin.php");
        exit;
    }
    else {
        echo "The log in info is incorrect, please try again.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Guestbook Log In</title>
    <link rel="stylesheet" href="guestbook.css">
</head>
<body>
    <h1>Guestbook Log In</h1>
    <h2>Please enter in your credentials below</h2>
    <form method="post" action="#">
        <label>Username:
            <input type="text" name="username">
        </label>
        <br>
        <label>Password:
            <input type="password" name="password">
        </label>
        <br>
        <input type="submit" id="submit" name="submit" value="Submit">
    </form>
</body>
</html>

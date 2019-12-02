<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guestbook Summary</title>
    <link rel="stylesheet" href="guestbook.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">

    <h1>Guestbook Summary</h1>
    <h2><a href="guestbook.html">Guestbook</a></h2>

    <?php
    include "guestbookDBcnx.php";
    //Test connection
    if ($cnxn) {
        echo "<p>Connected!</p>";
    } else {
        echo mysqli_connect_error();
    }
    //Define the query
    $sql = 'SELECT DISTINCT email FROM guestbook WHERE email != ""';
    $result = mysqli_query($cnxn, $sql);

    $subject = "Subject";
    $body = "Body";
    $headers = "Headers";
    $count = 0;

    while($row = mysqli_fetch_assoc($result)) {
        $to = $row['email'];
        echo "Sending email to ".$to;
        echo "<br>";
        $count++;
    }

    $success = mail($to, $subject, $body, $headers);
    if ($success){
        echo "successfully sent " .$count ." emails!";
    }
    else {
        echo mysqli_error($cnxn);
    }
    ?>

    <table id="guestbook-table" class="display">
        <thead>
        <tr>
            <th>Timestamp</th>
            <th>Name</th>
            <th>Email</th>
            <th>Title</th>
            <th>Company</th>
            <th>LinkedIn</th>
            <th>Message</th>
            <th>Mailing List</th>
            <th>How We Met</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql2 = 'SELECT * FROM guestbook';
        $table = mysqli_query($cnxn, $sql2);

        //Print the results
        while ($row = mysqli_fetch_assoc($table)) {
            $timestamp = $row['timestamp'];
            $name = $row['name'];
            $email = $row['email'];
            $title = $row['title'];
            $company = $row['company'];
            $linkedIn = $row['linkedIn'];
            $message = $row['message'];
            $mailingList = $row['mailingList'];
            $howMet = $row['howMet'];
            echo "<tr>
                    <td>$timestamp</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$title</td>
                    <td>$company</td>
                    <td>$linkedIn</td>
                    <td>$message</td>
                    <td>$mailingList</td>
                    <td>$howMet</td>
                  </tr>";
        }

        ?>
        </tbody>
    </table>



</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
    $("#guestbook-table").DataTable();
</script>
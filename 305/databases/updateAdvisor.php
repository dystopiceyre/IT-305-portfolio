<?php
    include "../guestbook/errors.php";
    include "database.php";
    //Test connection
    if ($cnxn) {
        echo "<p>Connected!</p>";
    } else {
        echo mysqli_connect_error();
    }
    echo "I am here";
    var_dump($_POST);
    $aid = $_POST['aid'];
    $sid = $_POST['sid'];


    if (!empty($aid) && !empty($sid) && is_numeric($aid)) {
        $aid = mysqli_real_escape_string($cnxn, $aid);
        $sid = mysqli_real_escape_string($cnxn, $aid);

        $sql = "UPDATE student 
        SET advisor = '$aid'
        WHERE sid = '$sid'";
        echo $sql;
        $result = mysqli_query($cnxn, $sql);
    }
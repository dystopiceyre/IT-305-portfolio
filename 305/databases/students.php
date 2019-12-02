<?php
//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GRC Student Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">

    <h3>Student Summary</h3>

    <?php
    //Connect to db --> ADD YOUR OWN CREDENTIALS!
    include "database.php";
    //Test connection
    if ($cnxn) {
        echo "<p>Connected!</p>";
    } else {
        echo mysqli_connect_error();
    }
    //Define the query
    $sql = 'SELECT s.sid, s.first AS student_first, s.last AS student_last, s.advisor, a.advisor_id, 
            a.advisor_first, a.advisor_last, birthdate, gpa
            FROM student s, advisor a 
            WHERE a.advisor_id = s.advisor
            ORDER BY student_last, student_first';
    //Send the query to the database
    $result = mysqli_query($cnxn, $sql);
    ?>

    <table id="student-table" class="display">
        <thead>
            <tr>
                <th>SID</th>
                <th>Student Name</th>
                <th>GPA</th>
                <th>Birthdate</th>
                <th>Advisor ID</th>
                <th>Advisor Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //Print the results
        while ($row = mysqli_fetch_assoc($result)) {
            $sid = $row['sid'];
            $sFirst = $row['student_first'];
            $sLast = $row['student_last'];
            $aid = $row['advisor'];
            $aFirst = $row['advisor_first'];
            $aLast = $row['advisor_last'];
            $gpa = $row['gpa'];
            $birthdate = $row['birthdate'];
            echo "<tr>
                    <td>$sid</td>
                    <td>$sLast, $sFirst</td>
                    <td>$gpa</td>
                    <td>$birthdate</td>
                    <td><input type = 'text' value='$aid' class='aid' data-sid='$sid'></td>
                    <td>$aLast, $aFirst</td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>

    $('.aid').on('change', function() {
        alert("aid: " + $(this).val()
        + ", sid: " + $(this).attr('data-sid'));
        $.post("updateAdvisor.php", {aid:aid, sid:sid});
    });


    $("#student-table").DataTable();
</script>

</body>
</html>
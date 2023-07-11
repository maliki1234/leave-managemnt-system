<?php

session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC") {
    $pc_id = $_SESSION['pc_id'];
    $staff_id = $_GET['staff_id'];
    $leave_type = $_GET['type'];
    $end_date = $_GET['end'];
    $start_date = $_GET['start'];

    // echo $staff_id;
    // echo $leave_type;

    $mysqli = new mysqli("localhost", "root", "", "lms");




    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    $sql1 = "UPDATE leave_requests SET leave_status = 'Approved' WHERE staff_id = '".$staff_id."' AND leave_type = '".$leave_type."' AND start_date = '".$start_date."' AND end_date = '".$end_date."'";

    $result = $mysqli->query($sql1);


    if ($result) {
        echo "completed";
        echo "<script>
        window.location=\"view_leave.php\";</script>";
    }





} else {
    header("Location: ../index.html");
}
;
$mysqli->close();
<?php

session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $staff_id = $_POST['staff_id'];
    $password = $_POST['password'];
    $user_type = "Staff";
    $mysqli = new mysqli("localhost", "root", "", "lms");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    $sql1 = "SELECT staff_id FROM staff WHERE staff_id = '".$staff_id."' ";
    $result = $mysqli->query($sql1);

    $sql2 = "INSERT INTO staff (staff_id, first_name, middle_name, last_name) VALUES ('$staff_id','$first_name', '$middle_name', '$last_name')";


    $sql3 = "INSERT INTO login (user_id, password, user_type) VALUES ('$staff_id', '$password', '$user_type')";


    $sql5 = "SELECT * FROM leave_types";
    $result5 = $mysqli->query($sql5);

    if ($result->fetch_array(MYSQLI_ASSOC) > 0) {
        echo 	"<script>
        alert(\"Staff email already exist, Please use differen Email ID.\");
    </script>";
        echo "<script>window.location=\"index.php\";</script>";
    } else {
        // tuna query insert ili tuingize data ambazo ni staff data
        $result2 = $mysqli->query($sql2);

        // hapa pia tuna query insert data into login table ili tuweze ku login baadae
        $result3 = $mysqli->query($sql3);


        // apa tunatengeneza array ya leave types

        while($row4 = $result5->fetch_array(MYSQLI_ASSOC)) {
            $leave_type = $row4['leave_type'];
            $no_of_days = $row4['no_of_days'];
            $sql6 = "INSERT INTO leave_statistics (staff_id, leave_type, maximum_leaves) VALUES ('$staff_id', '$leave_type', '$no_of_days')";
            // mysql_query($sql4, $connection) or die(mysql_error());
            $mysqli->query($sql6);

        }
        echo 	"<script>
					alert(\"Staff added.\");
				</script>";

        echo "<script>window.location=\"index.php\";</script>";

    }

} else {
    header("Location: ../index.html");
}
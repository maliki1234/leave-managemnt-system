<?php

session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {

    $staff_id = $_GET['staff'];


    $mysqli = new mysqli("localhost", "root", "", "lms");


    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
    //for primary key varification
    // $sql1 = "SELECT leave_type FROM leave_types WHERE leave_type = '".$leave_type."'";
    $sql1 = "DELETE FROM staff WHERE staff_id = '".$staff_id."'";
    $sql2 = "DELETE FROM login WHERE user_id = '".$staff_id."'";
    $sql3 = "DELETE FROM leave_requests WHERE staff_id = '".$staff_id."'";
    $sql4 = "DELETE FROM leave_statistics WHERE staff_id = '".$staff_id."'";
    // firing query


    echo 	"<script>
				alert(\"Do you really want to delete Staff ID = ".$staff_id."\");
			</script>";
    $mysqli->query($sql1);
    $mysqli->query($sql2);
    $mysqli->query($sql3);
    $mysqli->query($sql4);
    echo 	"<script>
				alert(\"Staff Deleted.\");
			</script>";
    echo "<script>window.location=\"view_stuff.php\";</script>";


    // if($result->num_rows > 0) {
    //     echo	"<script>
    // 				alert(\"'".$leave_type."' already exist !\");
    // 				window.location=\"add_leave.php\";</script>";
    // } else {
    //     echo"its not";
    //     $sql2 = "INSERT INTO leave_types VALUES ('".$leave_type."', '".$number_of_days."')";
    //     $sql3 = "SELECT staff_id FROM staff";
    //     // $result2 = mysql_query($sql3, $connection);
    //     $result2 = $mysqli -> query(($sql3));
    //     while($row = $result2 -> fetch_array(MYSQLI_ASSOC)) {
    //         $staff_id = $row['staff_id'];
    //         $sql4 = "INSERT INTO leave_statistics (staff_id, leave_type, maximum_leaves) VALUES( '".$staff_id."', '".$leave_type."', '".$number_of_days."')";
    //         $mysqli->query($sql4);
    //     }

    //     // mysql_query($sql2, $connection) or die(mysql_error());
    //     $mysqli->query($sql2);
    //     echo	"<script>
    // 				alert(\"New Leave Added and Leave Type is '".$leave_type."'\");
    // 				window.location=\"add_leave.php\";</script>";
    // }
}
$mysqli-> close();
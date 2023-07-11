<?php

$staff_id = $_POST['staff_id'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$middle_name = $_POST['middle_name'];
$password = $_POST['password'];
$user_type = "Staff";



echo $staff_id;
echo $first_name;
echo $last_name;
echo $middle_name;
echo $password;



$mysqli = new mysqli("localhost", "root", "", "lms");

// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}


$sql1 = "UPDATE staff SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name' WHERE staff_id = '$staff_id'";
$sql2 = "UPDATE login SET password = '$password', user_type = '$user_type' WHERE user_id = '$staff_id'";


// mysql_query($sql1, $connection);
$mysqli->query($sql1);
$mysqli->query($sql2);

echo 	"<script>
					alert(\"Staff Updated Successfully.\");
				</script>";
header("Location: view_stuff.php");


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
$mysqli-> close();
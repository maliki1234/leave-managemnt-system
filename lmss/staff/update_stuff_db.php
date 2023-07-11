<?php

session_start();
$staff_id = $_SESSION['staff_id'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$staff_ids = $_POST['staff_id'];

$mysqli = new mysqli("localhost", "root", "", "lms");

// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

$sql = "SELECT * FROM staff WHERE staff_id = '".$staff_id."'";

$sql2 = "UPDATE staff SET first_name='".$first_name."' , middle_name = '".$middle_name."' , last_name = '".$last_name."', staff_id = '".$staff_ids."' WHERE staff_id='".$staff_id."'";

$result = $mysqli->query($sql2);

if ($result) {
    echo "<script>
    function showAlert() {
      alert ('Hello world!'');
    }
    </script>";
} else {
    echo "<script>
    function showAlert() {
      alert ('Hello world!'');
    }
    </script>";
}

$result = $mysqli->query($sql);
// echo $result->num_rows;
if ($result->num_rows > 0) {
    echo	"<script>
    alert('uppdated sucess');
    window.location=\"profile.php\";</script>";
}


$mysqli->close();
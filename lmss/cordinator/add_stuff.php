<?php

$staff_id = $_POST['staff_id'];
$last_name = $_POST['last_name'];
$middle_name = $_POST['$middle_name'];
$fist_name = $_POST['$fist_name'];


$mysqli = new mysqli("localhost", "root", "", "lms");

// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}



$sql = "INSERT INTO staff (staff_id, last_name, fist_name , middle_name)
VALUES (".$staff_id.", ".$last_name.", ".$fist_name.", ".$middle_name.")";

$result = $mysqli->query($sql);

if ($result) {
    echo "<script> alert(\"leave\" </script>";
}
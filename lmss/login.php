<?php

$user_id = $_POST['txt_username'];
$password = $_POST['pswd_password'];

// $connection = @mysql_connect("localhost", "root", "") or die(mysql_error());
// $sql = "SELECT * FROM lms.login WHERE user_id = '".$user_id."' AND password = '".$password."'";
// $result = mysql_query($sql, $connection);


$mysqli = new mysqli("localhost", "root", "", "lms");

// Check connection
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

$sql = "SELECT * FROM login WHERE user_id = '".$user_id."' AND password = '".$password."'";

$result = $mysqli -> query($sql);


if($result) {

    // echo	"<script>
    // 	alert(\"Incorrect Username and Password Match.\");
    // 	</script>";


    while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        $user_type = $row['user_type'];
        $db_password = $row['password'];

        if((!(strcmp($db_password, $password))) && $user_type == "admin") {
            session_start();
            $_SESSION['sid'] = session_id();
            $_SESSION['user'] = $user_type;
            //Opens add_staff page if username and password matches
            header("Location: admin/index.php");
        } elseif((!(strcmp($db_password, $password))) && $user_type == "Staff") {
            session_start();
            $_SESSION['sid'] = session_id();
            $_SESSION['user'] = $user_type;
            $_SESSION['staff_id'] = $user_id;
            echo
            //Opens add_staff page if username and password matches
            header("Location: staff/index.php");
            echo "staff";
        } elseif((!(strcmp($db_password, $password))) && $user_type == "PC") {
            session_start();
            $_SESSION['sid'] = session_id();
            $_SESSION['user'] = $user_type;
            $_SESSION['pc_id'] = $user_id;
            header("Location: cordinator/index.php");
            //Opens add_staff page if username and password matches
            //header("Location: admin/add_staff.php");
        }
    }
} else {
    echo	"<script>
			alert(\"Incorrect Username and Password Match.\");
			window.location=\"index.html\";</script>";
}
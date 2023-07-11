<?PHP

	session_start();
	$staff_id = $_SESSION['staff_id'];
	// $leave_duration = $_POST['leave_duration'];
	$leave_type = $_POST['leave_type'];
	$leave_date = $_POST['leave_date'];
	
	$status = "Pending";
	
	$mysqli = new mysqli("localhost","root","","lms");

	// Check connection
	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}
	
	$sql4 = "SELECT * FROM leave_statistics WHERE staff_id = '".$staff_id."' AND leave_type = '".$leave_type."'";
	// $result4 = mysql_query($sql4, $connection) or die(mysql_error());
	$result4 = $mysqli->query($sql4);

// requested completed




	while($row4 = $result4->fetch_array(MYSQLI_ASSOC))
	{
		$maximum_leaves = $row4['maximum_leaves'];
		$leaves_taken = $row4['leaves_taken'];
	}


    //  tunataka kujumlisha siku zilizotumika na zile tuitakazo tumia

    
	$new = $leaves_taken + 1;
	$balance_leaves = $maximum_leaves - $leaves_taken;
	
	// if($no_of_days > $maximum_leaves)
	// {
	// 	echo	"<script>
	// 			alert('Maximum ".$maximum_leaves." Days Allowed.');
	// 			window.location=\"apply_leave.php\";</script>";
	// }
	if($new > $maximum_leaves)
	{
		echo	"<script>
				alert('You have already taken " .$leaves_taken." leaves, Now you only request only for ".$balance_leaves." days');
				window.location=\"apply_leave.php\";</script>";
	}
	else
	{
		
			$sql = "SELECT * FROM leave_requests WHERE start_date = '".$leave_date."' AND end_date = '".$leave_date."' AND staff_id = '".$staff_id."'";
			// $result = mysql_query($sql, $connection) or die(mysql_error());
			$result = $mysqli->query($sql);
			if(mysqli_num_rows($result) == 0 )
			{
				$sql3 = "INSERT INTO leave_requests VALUES ('".$staff_id."', '".$leave_type."', '".$leave_date."', '".$leave_date."', '1', '".date("Y-m-d")."', '".$status."')";
				// mysql_query($sql3, $connection) or die(mysql_error());
				$mysqli->query($sql3);
			echo	"<script>
					alert(\"Leave Request Submitted.\");
					window.location=\"apply_leave.php\";</script>";
			}
			else
			{
				echo	"<script>
					alert(\"You have already taken a leave for these days !.\");
					window.location=\"apply_leave.php\";</script>";
			}
		
		
	}
	
	// mysql_close($connection);
	$mysqli->close();
	
	
?>
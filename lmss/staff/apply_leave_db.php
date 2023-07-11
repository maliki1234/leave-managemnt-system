<?PHP

	session_start();
	$staff_id = $_SESSION['staff_id'];
	// $leave_duration = $_POST['leave_duration'];
	$leave_type = $_POST['leave_type'];
	// $leave_date = $_POST['leave_date'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$no_of_days = $_POST['days_requested'];
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
	while($row4 = $result4->fetch_array(MYSQLI_ASSOC))
	{
		$maximum_leaves = $row4['maximum_leaves'];
		$leaves_taken = $row4['leaves_taken'];
	}
	$new = $leaves_taken + $no_of_days;
	$balance_leaves = $maximum_leaves - $leaves_taken;
	
	if($no_of_days > $maximum_leaves)
	{
		echo	"<script>
				alert('Maximum ".$maximum_leaves." Days Allowed.');
				window.location=\"apply_leave.php\";</script>";
	}
	if($new > $maximum_leaves)
	{
		echo	"<script>
				alert('You have already taken " .$leaves_taken." leaves, Now you only request only for ".$balance_leaves." days');
				window.location=\"apply_leave.php\";</script>";
	}
	else
	{
			$sql1 = "SELECT start_date, end_date FROM leave_requests WHERE  '".$start_date."' BETWEEN start_date AND end_date AND staff_id = '".$staff_id."'";
		
			$sql2 = "SELECT start_date, end_date FROM leave_requests WHERE  '".$end_date."' BETWEEN start_date AND end_date AND staff_id = '".$staff_id."'";
		
			// $result1 = mysql_query($sql1, $connection) or die(mysql_error());
			$result1 = $mysqli->query($sql1);

			// $result2 = mysql_query($sql2, $connection) or die(mysql_error());
			$result2 = $mysqli->query($sql2);
		
			if(mysqli_num_rows($result1) == 0 && mysqli_num_rows($result2) == 0)
			{
				
				$sql3 = "INSERT INTO leave_requests VALUES ('".$staff_id."', '".$leave_type."', '".$start_date."', '".					$end_date."', '".$no_of_days."', '".date("Y-m-d")."', '".$status."')";
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
<?php

$i = 1;
session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "Staff") {
    $staff_id = $_SESSION['staff_id'];

    $mysqli = new mysqli("localhost", "root", "", "lms");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    $sql2 = "SELECT * FROM staff WHERE staff_id = '".$staff_id."'";

    $sql = "SELECT * FROM leave_requests WHERE staff_id = '".$staff_id."'";

    $result2 =$mysqli->query($sql2);

    while($row2 = $result2->fetch_array()) {
        // echo $row1['first_name'];
        $first_name = $row2['first_name'];
        $middle_name = $row2['middle_name'];
        $last_name = $row2['last_name'];

        // echo "this is the ";
    }

    $result =$mysqli->query($sql);

    if(!$result) {
        echo 	"<script>
					alert(\"No Leave History to Show!\");
					window.location=\"index.php\";</script>";
    }
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="../static/css/index.css">
</head>

<body>
    <div class="w-screen h-screen overflow-hidden">
        <div class="w-full bg-gray-300 items-center flex justify-between px-10 ">
            <div class="text-6xl font-bold text-gray-700"> leave mgs </div>
            <ul class="flex list-none">
                <li class="px-1 mx-1">
                    <a href="#" class="capitalize text-gray-900 hoever:text-gray-700 no-underline"> home</a>
                </li>
                <li class="px-1 mx-1">
                    <a href="../logout.php" class="capitalize text-gray-900 hoever:text-gray-700 no-underline">
                        logout</a>
                </li>
                <li class="px-1 mx-1">
                    hello! <?php echo $first_name?>
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-7">
            <aside class="col-span-1  pt-10 bg-gray-300 h-screen">
                <ul class="flex flex-col ">
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./apply_leave.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">apply
                            leave </a>

                    </li>
                    <!-- <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="#"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            leave status </a>

                    </li> -->
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./profile.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            profile</a>

                    </li>
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="#"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            leave history </a>

                    </li>

                </ul>
            </aside>
            <div class="col-span-6">
                <div class=" bg-gray-300  py-2 w-11/12 m-3">
                    <h1 class="text-4xl font-bold text-gray-800 uppercase text-center"> leave history </h1>
                    <div class=" w-10/12 py-1 mx-auto bg-white my-4 rounded-sm"></div>

                    <table class="w-full">
                        <thead class="py-2">
                            <tr class="border-b-1 border-gray-500">
                                <th class="capitalize text-left">no</th>
                                <th class="capitalize text-left">leave type</th>
                                <th class="capitalize text-left">start date</th>
                                <th class="capitalize text-left"> ende date</th>
                                <th class="capitalize text-left"> number of days</th>
                                <th class="capitalize text-left"> date aplied</th>
                                <th class="capitalize text-left"> status</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
                                    $leave_type = $row['leave_type'];
                                    $start_date = $row['start_date'];
                                    $end_date = $row['end_date'];
                                    $no_of_days = $row['days_requested'];
                                    $date_applied = $row['date_applied'];
                                    $status = $row['leave_status'];

                                    echo "
                                    <tr>
                                    <td class='text-sm'> ".$i." </td>
                                    <td class='text-sm'> ".$leave_type." </td>
                                    <td class='text-sm'>".$start_date."</td>
                                    <td class='text-sm'> ".$end_date." </td>
                                    <td class='text-sm'> ".$no_of_days." </td>
                                    <td class='text-sm'> ".$date_applied." </td>
                                    <td class='text-sm'> ".$status." </td>
    
                                </tr>";

                                    $i++;

                                }

    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>


<?php
} else {
    header("Location: ../index.html");
}
$mysqli->close();
?>
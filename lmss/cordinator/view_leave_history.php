<?php

session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC") {
    $pc_id = $_SESSION['pc_id'];
    $staff_id = $_GET['staff_id'];
    $mysqli = new mysqli("localhost", "root", "", "lms");
    $i = 1;
    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
    // echo $staff_id;

    $sql1 = "SELECT * FROM staff WHERE staff_id = '".$pc_id."'";
    $sql2 = "SELECT * FROM staff WHERE staff_id = '".$staff_id."'";
    $sql3 = "SELECT * FROM leave_requests WHERE staff_id = '".$staff_id."'";

    $result = $mysqli->query($sql1);
    $result2 = $mysqli->query($sql2);
    $result3 = $mysqli->query($sql3);

    while($row1 = $result->fetch_array(MYSQLI_ASSOC)) {
        $first_name = $row1['first_name'];
        $middle_name = $row1['middle_name'];
        $last_name = $row1['last_name'];
    }

    while($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
        $first_staff_name = $row2['first_name'];
        $middle_staff_name = $row2['middle_name'];
        $last_staff_name = $row2['last_name'];
        // echo $first_staff_name;
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
                    <a href="#" class="capitalize text-gray-900 hoever:text-gray-700 no-underline"> logout</a>
                </li>
                <li class="px-1 mx-1">
                    hello! <?php echo $first_name ?>
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-7">
            <aside class="col-span-1  pt-10 bg-gray-300 h-screen">
                <ul class="flex flex-col ">
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./view_leave.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            leave </a>

                    </li>
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./view_stuff.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            stuff </a>

                    </li>

                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./view_leave.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">leave
                            request </a>

                    </li>

                </ul>
            </aside>
            <div class="col-span-6">
                <div class=" bg-gray-300  py-2 w-11/12 m-3">
                    <h1 class="text-4xl font-bold text-gray-800 uppercase text-center">
                        <?php echo ''.$first_staff_name.'s' ?>
                        leave </h1>
                    <div class=" w-10/12 py-1 mx-auto bg-white my-4 rounded-sm"></div>

                    <table class="w-full">
                        <thead class="py-2">
                            <tr class="border-b-1 border-gray-500">
                                <th class="capitalize text-left">no</th>
                                <th class="capitalize text-left">leave type</th>
                                <th class="capitalize text-left"> starting</th>
                                <th class="capitalize text-left"> ending</th>
                                <th class="capitalize text-left"> No. of Days</th>
                                <th class="capitalize text-left"> date applied</th>
                                <th class="capitalize text-left"> status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td class="text-sm"> 1 </td>
                                <td class="text-sm"> maliki kowero </td>
                                <td class="text-sm"> imergiency</td>
                                <td class="text-sm  "> 17-0ct-2021 </td>
                                <td class="text-sm "> 1 </td>
                                <td class="text-sm  "> 27-0ct-2021 </td>
                                <td class="text-sm flex "> <span
                                        class="text-gray-500 mx-1 hover:text-gray-700 cursor-pointer "> accept
                                    </span> <span class="text-red-500 hover:text-red-700 cursor-pointer"> reject
                                    </span> </td>


                            </tr> -->
                            <?php

                            while ($row5 = $result3->fetch_array(MYSQLI_ASSOC)) {
                                $leave_type = $row5['leave_type'];
                                $start_date = $row5['start_date'];
                                $end_date = $row5['end_date'];
                                $days_requested  = $row5['days_requested'];
                                $date_applied = $row5['date_applied'];
                                $status = $row5['leave_status'];
                                // $no_of_days = $start_date - $end_date;

                                echo '<tr>
                                <td class="text-sm"> '.$i.' </td>
                                
                                <td class="text-sm"> '.$leave_type.'</td>
                                <td class="text-sm  "> '.$start_date.'</td>
                                <td class="text-sm  "> '.$end_date.'</td>

                                <td class="text-sm "> '.$days_requested.' </td>
                                <td class="text-sm  "> '.$date_applied.' </td>
                                <td class="text-sm  "> '.$status.' </td>

                               


                            </tr>';
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
    header("Location:./../index.html");
}
$mysqli->close();

?>
<?php
session_start();
if ($_SESSION['sid'] === session_id() && $_SESSION['user']== "PC") {
    $i=1;
    $pc_id = $_SESSION['pc_id'];
    $mysqli = new mysqli("localhost", "root", "", "lms");

    if ($mysqli -> connect_errno) {
        echo"Failed to connect to mysql" .$mysqli-> connect_errno;
        exit();
    }

    $sql2 = "SELECT * FROM staff WHERE staff_id = '".$_SESSION['pc_id']."'";
    $result2 = $mysqli->query($sql2);

    $sql = "SELECT * FROM leave_requests WHERE leave_status = 'pending'";
    $result = $mysqli->query($sql);

    if ($result2) {
        while ($rows = $result2->fetch_array()) {
            $email = $rows['staff_id'];
            $first_name = $rows['first_name'];
        }
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
                    <h1 class="text-4xl font-bold text-gray-800 uppercase text-center"> view leave </h1>
                    <div class=" w-10/12 py-1 mx-auto bg-white my-4 rounded-sm"></div>

                    <table class="w-full">
                        <thead class="py-2">
                            <tr class="border-b-1 border-gray-500">
                                <th class="capitalize text-left">no</th>
                                <th class="capitalize text-left">stuff name</th>
                                <th class="capitalize text-left">leave type</th>
                                <th class="capitalize text-left"> starting</th>
                                <th class="capitalize text-left"> No. of Days</th>
                                <th class="capitalize text-left"> date applied</th>
                                <th class="capitalize text-left"> action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <!-- <td class="text-sm"> 1 </td>
                                <td class="text-sm"> maliki kowero </td>
                                <td class="text-sm"> imergiency</td>
                                <td class="text-sm  "> 17-0ct-2021 </td>
                                <td class="text-sm "> 1 </td>
                                <td class="text-sm  "> 27-0ct-2021 </td>
                                <td class="text-sm flex "> <span
                                        class="text-gray-500 mx-1 hover:text-gray-700 cursor-pointer "> accept
                                    </span> <span class="text-red-500 hover:text-red-700 cursor-pointer"> reject
                                    </span> </td> -->

                            <?php
                                        while ($row= $result->fetch_array(MYSQLI_ASSOC)) {
                                            $email = $row['staff_id'];
                                            $type = $row['leave_type'];
                                            $start = $row['start_date'];
                                            $end = $row['end_date'];
                                            $days = $row['days_requested'];
                                            $applied = $row['date_applied'];

                                            // echo $email;
                                            echo '<tr><td class="text-sm"> '.$i.' </td>
                                            <td class="text-sm"> '.$email.' </td>
                                            <td class="text-sm"> '.$type.'</td>
                                            <td class="text-sm  "> '.$start.' </td>
                                            <td class="text-sm "> '.$end.' </td>
                                            <td class="text-sm  "> '.$applied.' </td>
                                            <td class="text-sm flex "> <span
                                                    class="text-gray-500 mx-1 hover:text-gray-700 cursor-pointer "> <a href="./accept.php?staff_id='.$email.'& type='.$type.' & end='.$end.'& start='.$start.'" class="no-underline">accept</a> 
                                                </span> <span class="text-red-500 hover:text-red-700 cursor-pointer"> <a href="./reject.php?staff_id='.$email.'& type='.$type.' & end='.$end.'& start='.$start.'" class="no-underline">reject</a>
                                                </span> </td></tr>';
                                            $i++;
                                        }

    ?>


                        </tbody>
                    </table>
                    <a href="./accept.php?staff_id=$email,type=$type,start=$start" class="no-underline"></a>
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
<?php
session_start();
if ($_SESSION['sid'] === session_id() && $_SESSION['user']== "admin") {
    $i=1;
    $mysqli = new mysqli("localhost", "root", "", "lms");

    if ($mysqli -> connect_errno) {
        echo"Failed to connect to mysql" .$mysqli-> connect_errno;
        exit();
    }

    $sql = "SELECT * FROM leave_types";
    $result = $mysqli->query($sql);

    if ($result->num_rows == 0) {
        echo	"<script>
				alert(\"'".$leave_type."' no leve found !\");
				window.location=\"add_leave.php\";</script>";
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
                    hello! admin
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-7">
            <aside class="col-span-1  pt-10 bg-gray-300 h-screen">
                <ul class="flex flex-col ">
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="index.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">add
                            stuff </a>

                    </li>
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./view_stuff.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            stuff </a>

                    </li>
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./add_leave.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">add
                            leave </a>

                    </li>
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./view_leave.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            leave </a>

                    </li>
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./view_coordinator.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">codinators
                        </a>

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

                                <th class="capitalize text-left"> number of days</th>
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
                                            $type = $row['leave_type'];
                                            $no_of_days = $row['no_of_days'];
                                            echo '<tr><td class="text-sm"> '.$i.' </td>
                                            <td class="text-sm"> '.$type.'</td>
                                            <td class="text-sm  "> '.$no_of_days.' </td>                                      
                                            <td class="text-sm flex "> <span
                                                    class="text-red-500 mx-1 hover:text-red-700 cursor-pointer "> <a href="./delete_leave.php?type='.$type.'& no_of_days='.$no_of_days.'" class="no-underline">delete</a> 
                                                </span> 
                                                </span> </td></tr>';
                                            $i++;
                                        }

    ?>
                            <!-- <span class="text-red-500 hover:text-red-700 cursor-pointer">  <a href="./edit_leave.php?type='.$type.'& no_of_days='.$no_of_days.'" class="no-underline">edit</a> -->

                        </tbody>
                    </table>
                    <!-- <a href="./accept.php?staff_id=$email,type=$type,start=$start" class="no-underline"></a> -->
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
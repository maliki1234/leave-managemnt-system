<?php
session_start();
if ($_SESSION['sid'] === session_id() && $_SESSION['user']== "admin") {
    $i=1;
    $mysqli = new mysqli("localhost", "root", "", "lms");

    if ($mysqli -> connect_errno) {
        echo"Failed to connect to mysql" .$mysqli-> connect_errno;
        exit();
    }


    $sql3 = "SELECT * 
FROM login INNER JOIN  staff
     WHERE user_id = staff_id AND user_type = 'PC' ";


    $result3 = $mysqli->query($sql3);


    // while ($row4=$result3->fetch_array(MYSQLI_ASSOC)) {
    //     $user = $row4['staff_id'];
    //     $first_name = $row4['first_name'];
    //     echo $first_name;
    // }

    // $sql = "SELECT * FROM login WHERE user_type = 'PC'" ;
    // $result = $mysqli->query($sql);

    // while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    //     $staff_id = $row['user_id'];
    //     // echo $staff_id;

    //     $sql1 = "SELECT * FROM staff WHERE staff_id='".$staff_id."' ";
    //     $result1=  $mysqli->query($sql1);
    //     // while ($row2 = $result1->fetch_array(MYSQLI_ASSOC)) {
    //     //     $staff_ids = $row2['staff_id'];
    //     //     $first_name = $row2['first_name'];
    //     //     $last_name = $row2['last_name'];
    //     //     // echo $staff_ids;
    //     // }
    //     // echo $staff_id;
    // }




    // echo $staff_id;

    if ($result3->num_rows > 0) {


    } else {
        echo	"<script>
    alert(\"'please add coordinator !\");
    window.location=\"asing_coordinator.php\";</script>";
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
                    hello! logan
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-7">
            <aside class="col-span-1  pt-10 bg-gray-300 h-screen">
                <ul class="flex flex-col ">
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./index.php"
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
                    <h1 class="text-4xl font-bold text-gray-800 uppercase text-center"> view stuff </h1>
                    <div class=" w-10/12 py-1 mx-auto bg-white my-4 rounded-sm"></div>

                    <table class="w-full">
                        <thead class="py-2">
                            <tr class="border-b-1 border-gray-500">
                                <th class="capitalize text-left">no</th>
                                <th class="capitalize text-left">name</th>
                                <th class="capitalize text-left">email</th>
                                <th class="capitalize text-left"> action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td class="text-sm"> 1 </td>
                                <td class="text-sm"> maliki kowero </td>
                                <td class="text-sm"> malikikoero@gmail.com </td>
                                <td class="text-sm flex "> <span class="mx-4">edit</span> <span>delete</span> </td>

                            </tr> -->

                            <?php


while ($row = $result3->fetch_array()) {
    $first_name = $row['first_name'];
    $middle_name = $row['middle_name'];
    $last_name = $row['last_name'];
    $staff_id = $row['staff_id'];

    echo ' <tr>
    <td class="text-sm"> '.$i.' </td>
    <td class="text-sm"> '.$first_name.' '.$last_name.' </td>
    <td class="text-sm"> '.$staff_id.' </td>
    <td class="text-sm flex "> <span class="mx-4"><a href="./edit_stuff.php?staff='.$staff_id.'" class="text-blue-500"> edit</a></span> <span><a href="./delete_stuff.php?staff='.$staff_id.'" class="text-red-500 cursor-pointer"> delete</a></span> </td>

</tr>';

    $i++;

}

    ?>



                        </tbody>
                    </table>
                    <div class="grid justify-end px-12 ">
                        <a href="./asing_coordinator.php" class="text-gray-700 py-1 px-3 bg-green-300 rounded-sm">add
                            coordinator</a>
                    </div>


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
<?php
session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "Staff") {
    $staff_id = $_SESSION['staff_id'];

    $mysqli = new mysqli("localhost", "root", "", "lms");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    $sql1 = "SELECT * FROM staff WHERE staff_id = '".$staff_id."'";

    $sql2 = "SELECT * FROM leave_statistics WHERE staff_id = '".$staff_id."'";

    $result1 = $mysqli-> query($sql1);
    // echo $staff_id;

    // echo mysqli_num_rows ( $result1 );

    $result2 = $mysqli-> query($sql2);

    while($row1 = $result1->fetch_array()) {
        // echo $row1['first_name'];
        $first_name = $row1['first_name'];
        $middle_name = $row1['middle_name'];
        $last_name = $row1['last_name'];

        // echo "this is the ";
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
                    <a href="" class="capitalize text-gray-900 hoever:text-gray-700 no-underline"> home</a>
                </li>
                <li class="px-1 mx-1">
                    <a href="../logout.php" class="capitalize text-gray-900 hoever:text-gray-700 no-underline">
                        logout</a>
                </li>
                <li class="px-1 mx-1">
                    hello!
                    <?php echo $_SESSION['user'];?>
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-7">
            <aside class="col-span-1  pt-10 bg-gray-300 h-screen">
                <ul class="flex flex-col ">
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="apply_leave.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">apply
                            leave history </a>

                    </li>

                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="#"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            profile</a>

                    </li>
                    <li class="w-full py-1 my-3 border-b py-4 px-4  border-gray-500">
                        <a href="./leave_history.php"
                            class=" capitalize text-2xl hover:text-gray-600 font-semibold no-underline text-gray-700">view
                            leave history </a>

                    </li>

                </ul>
            </aside>
            <div class="col-span-6">
                <div class=" bg-gray-300  py-2 w-11/12 m-3">
                    <h1 class="text-4xl font-bold text-gray-800 uppercase text-center"> add stuff </h1>
                    <div class=" w-10/12 py-1 mx-auto bg-white my-4 rounded-sm"></div>
                    <div class="my-4 mx-12">
                        <h1 class="font-bold text-center text-2xl"> basic info </h1>
                        <p class="text-md capitalize my-4">
                            name: <?php echo "" .$first_name." ".$last_name?>
                        </p>
                        <p class="text-md my-4">
                            email: <?php echo $staff_id?>
                        </p>

                    </div>
                    <div class="my-4 mx-12">
                        <h1 class="font-bold text-center text-2xl"> current leave </h1>
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-500">
                                    <th class="text-left uppercase">
                                        leave types
                                    </th>
                                    <th class="text-left uppercase">
                                        maximum alowed leave
                                    </th>
                                    <th class="text-left uppercase">
                                        leave taken
                                    </th>
                                    <th class="text-left uppercase">
                                        remain leave
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php

                                while ($row2 = $result2-> fetch_array(MYSQLI_ASSOC)) {
                                    $leave_type = $row2['leave_type'];
                                    $maximum_leaves = $row2['maximum_leaves'];
                                    $laves_taken = $row2['leaves_taken'];
                                    $remaining_leaves = $maximum_leaves - $laves_taken;

                                    echo" <tr>
                                <td> ".$leave_type."</td>
                                <td> ".$maximum_leaves."</td>
                                <td>".$laves_taken."</td>
                                <td>".$remaining_leaves."</td>
                            </tr>";
                                }

    ?>
                            </tbody>
                        </table>

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
    header("Location:../index.html");
}
$mysqli->close();
?>
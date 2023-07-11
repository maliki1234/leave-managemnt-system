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
    $sql = "SELECT * FROM leave_types";
    $result = $mysqli -> query($sql);
    // $result1 = $mysqli -> query($sql);

    $sql2 = "SELECT * FROM staff WHERE staff_id = '".$staff_id."'";

    // $sql = "SELECT * FROM leave_requests WHERE staff_id = '".$staff_id."'";

    $result2 =$mysqli->query($sql2);

    while($row2 = $result2->fetch_array()) {
        // echo $row1['first_name'];
        $first_name = $row2['first_name'];
        $middle_name = $row2['middle_name'];
        $last_name = $row2['last_name'];

        // echo "this is the ";
    }

    // if ($result) {
    // 	echo	"<script>
    // 	alert(\"Incorrect Username and Password Match.\");
    // 	</script>";
    // }
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
                        <a href="profile.php"
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
                    <h1 class="text-4xl font-bold text-gray-800 uppercase text-center"> apply leave </h1>
                    <div class="ml-64">
                        <p class="text-2xl font-black capitalize">select number of days:</p>
                          <input type="radio" id="html" name="days" value="one">
                          <label for="html">one</label><br>
                          <input type="radio" id="css" name="days" value="multiple">
                        <label for="html">multiple</label><br>
                        <div class="inline-block py-2 px-4 bg-blue-400" onclick="days()"> select </div>
                    </div>
                    <div class="  w-10/12 py-1 mx-auto bg-white my-4 rounded-sm"></div>
                    <div class="hidden" id="one">
                        <form action="./single_day_apply_leave.php" method="post" class="px-4  ">


                            <div class="my-1">
                                <label for=""> leave type</label>
                                <!-- <input type="text" name="leave-type" placeholder="email"
                                    class="w-full py-2 px-1 rounded-sm" id=""> -->

                                <select name="leave_type" class=" w-full py-2 px-1 rounded-sm" id="leave_tyoe">

                                    <?php
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                $leave_type = $row['leave_type'];
                                echo "<option value=\"".$leave_type."\"> ".$leave_type." </option>";
                            }


    ?>


                                </select>

                            </div>
                            <div class="my-1">
                                <label for=""> Date</label>
                                <input type="date" name="leave_date" placeholder="pick a date"
                                    class="w-full py-2 px-1 rounded-sm" id="leave_date">

                            </div>
                            <button type="submit"
                                class="inline-block my-2 py-4 bg-blue-600 text-white rounded-md outline-none px-12 bg">apply
                                leave</button>

                        </form>
                    </div>
                    <div class="hidden" id="multiple">
                        <form action="apply_leave_db.php" method="post" class="px-4 ">

                            <div class="my-1">
                                <label for="">leave type</label>
                                <!-- <input type="date" name="start_date" placeholder="pick a date"
                                    class="w-full py-2 px-1 rounded-sm" id=""> -->
                                <select name="leave_type" class="w-full py-2 px-1 rounded-sm" id="">
                                    <!-- <option value=""></option> -->
                                    <?php
        while ($row4=$result1->fetch_array(MYSQLI_ASSOC)) {
            $leave_type = $row4['leave_type'];
            echo "<option value=\"".$leave_type."\"> ".$leave_type." </option>";
        }
    ?>
                                </select>

                            </div>


                            <div class="my-1">
                                <label for="">start Date</label>
                                <input type="date" name="start_date" placeholder="pick a date"
                                    class="w-full py-2 px-1 rounded-sm" id="">

                            </div>
                            <div class="my-1">
                                <label for="">end Date</label>
                                <input type="date" name="end_date" placeholder="pick a date"
                                    class="w-full py-2 px-1 rounded-sm" id="">

                            </div>
                            <div class="my-1">
                                <label for="">Day Requested</label>
                                <input type="text" name="days_requested" placeholder="pick a date"
                                    class="w-full py-2 px-1 rounded-sm" id="">

                            </div>
                            <button
                                class="inline-block my-2 py-4 bg-blue-600 text-white rounded-md outline-none px-12 bg">apply
                                leave</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
    var selected = document.getElementsByName("days")
    const days = () => {
        selected.forEach(element => {
            if (element.checked) {

                // console.log(element.value)
                if (element.value == "one") {
                    // console.log(element.value)
                    document.getElementById("one").style.display = "block";
                    document.getElementById('multiple').style.display = "none";
                    // console.log(document.getElementById("one").style.display)
                    // console.log("this is multiple")
                } else {
                    // console.log("sjlkfjsldf")
                    // console.log(document.getElementById("multiple").style.display)
                    document.getElementById("one").style.display = "none";
                    document.getElementById('multiple').style.display = "block";
                }
            }
        });
    }
    </script>
</body>

</html>


<?php

}
// else
// {
//     header("Location: ../index.html");
// }
$mysqli->close()

?>
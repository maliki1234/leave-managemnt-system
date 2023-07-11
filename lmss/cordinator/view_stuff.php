<?php
session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "PC") {
    $pc_id = $_SESSION['pc_id'];
    $i = 1;

    $mysqli = new mysqli("localhost", "root", "", "lms");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    $sql = "SELECT * FROM staff ";

    // $result = mysql_query($sql, $connection);
    $result = $mysqli->query($sql);

    $no_of_rows = mysqli_num_rows($result);

    if($no_of_rows == 0) {
        echo 	"<script>
					alert(\"No Leave Requests to Show!\");
					window.location=\"index.html\";</script>";
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
                    hello! logan
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
                                <td class="text-sm flex "> </td>

                            </tr>
                            <span onclick="leaveHistory(" .staff_id.")"> view leave history</span> -->

                            <?php
                            while ($rows = $result->fetch_array(MYSQLI_ASSOC)) {
                                $staff_id = $rows['staff_id'];
                                $first_name = $rows['first_name'];

                                $staff_ids = strval($staff_id);

                                $last_name = $rows['last_name'];

                                echo ' <tr>
                               <td class="text-sm"> '.$i.'</td>
                               <td class="text-sm"> '.$first_name. '' .$last_name.' </td>
                               <td class="text-sm"> '.$staff_id.' </td>
                               <td class="text-sm flex" >  <a href="./view_leave_history.php?staff_id='.$staff_id.'" class="text-red-500 hover:text-red-700 cursor-pointer"> view leave history</a></td>
                           </tr>';
                                $i++;

                            };
    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>
    <script>
    const leaveHistory = () => {
        console.log("maliki")
    }
    </script>
</body>

</html>

<?php
} else {
    header("Location: ./../index.html");
}
$mysqli->close();
?>
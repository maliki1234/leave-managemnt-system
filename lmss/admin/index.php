<?php
session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin") {
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
                    <h1 class="text-4xl font-bold text-gray-800 uppercase text-center"> add stuff </h1>
                    <div class=" w-10/12 py-1 mx-auto bg-white my-4 rounded-sm"></div>
                    <form action="./add_staff.php" method="post" class="px-4">
                        <div class="my-1">
                            <label for=""> name</label>
                            <div class="grid gap-1 grid-cols-3">
                                <input type="text" name="first_name" placeholder="first name"
                                    class="w-full py-2 px-1 rounded-sm" id="">
                                <input type="text" name="middle_name" placeholder="second name"
                                    class="w-full py-2 px-1 rounded-sm" id="">
                                <input type="text" name="last_name" placeholder="last name"
                                    class="w-full py-2 px-1 rounded-sm" id="">
                            </div>
                        </div>
                        <div class="my-1">
                            <label for=""> email</label>
                            <input type="email" name="staff_id" placeholder="email" class="w-full py-2 px-1 rounded-sm"
                                id="">

                        </div>
                        <div class="my-1">
                            <label for=""> password</label>
                            <input type="password" name="password" placeholder="password"
                                class="w-full py-2 px-1 rounded-sm" id="">

                        </div>
                        <button
                            class="inline-block my-2 py-4 bg-blue-600 text-white rounded-md outline-none px-12 bg">add
                            stuff</button>

                    </form>
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
?>
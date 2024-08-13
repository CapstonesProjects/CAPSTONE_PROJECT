<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Login - LOA OSA</title>
</head>

<body>
    <header>
        <div class="logo-img-container">
            <a href="#" class="logo"><img src="images/osa_logo.png" alt=""></a>
        </div>
        <div class="logo-letter-container">
            <h1 class="LL1 logo-letter">LOA</h1>
            <p class="LL2 logo-letter">Office of Student Affairs</p>

            <div class="IPI-container">
                <p class="IPI-letter">Integrity</p>
                <p class="IPI-letter">Professionalism</p>
                <p class="IPI-letter">Innovation</p>
            </div>
        </div>


        <ul class="navlist">
            <li><a href="#home">Home</a></li>
            <li><a href="#learn">About Us</a></li>
            <li><a href="#about">Events</a></li>
            <li><a href="#contact">Scholar</a></li>
        </ul>

        <!-- <ul class="navlist">
            <li><a href="#">Login</a></li>
        </ul> -->

        <ul class="navlist">
            <li class="relative">
                <button id="loginDropdownLink" data-dropdown-toggle="loginDropdown" class="flex items-center text-xl justify-between w-full py-2 px-3 text-white rounded hover:bg-black-300 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-black-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-blue-400">
                    Login
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Login Dropdown menu -->
                <div id="loginDropdown" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="loginDropdownLink">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" style="color: black;">Student</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" style="color: black;">OSA Staff</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </header>

    <!-- <section id="home" class="home">
        <div class="text-title-container">
            <h1 class="title-sm">Welcome to the</h1>
            <h4 class="title-xl">Lyceum of Alabang</h4>
            <h4 class="title-xl">Office of Student Affairs</h4>
        </div>
    </section> -->
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

</html>
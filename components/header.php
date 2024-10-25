<style>
    *{
        text-decoration: none;
        list-style: none;
    }
</style>

<header class="" >
        <div class="logo-text-container">
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
        </div>


        <ul class="navlist">
            <li><a href="./index.php">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#events">Events</a></li>
            <li><a href="#scholar">Scholar</a></li>
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
                <div id="loginDropdown" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="loginDropdownLink">
                        <li>
                            <a href="./Student_Index.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" style="color: black;">Student</a>
                        </li>
                        <li>
                            <a href="./OSA_Index.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" style="color: black;">OSA Staff</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </header>
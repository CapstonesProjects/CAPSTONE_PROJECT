
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/student_profile.css">
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <title>OSA Send Message - LOA OSA</title>
</head>

<body class="font-poppins antialiased bg-gray-200">
    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Sidebar Layout</title>


    <style>
        body {
            font-family: 'Poppins', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        #view {
            height: 100%;
            display: flex;
            flex-direction: row;
        }

        #sidebar {
            background-color: #d1d5db;
            /* bg-gray-300 */
            height: 100vh;
            display: block;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            /* shadow-xl */
            padding: 0 3rem;
            /* px-12 */
            width: 7.5rem;
            /* w-30 */
            transition: transform 0.3s ease-in-out;
            overflow-x: hidden;
        }

        @media (min-width: 768px) {
            #sidebar {
                width: 15rem;
                /* md:w-60 */
            }
        }

        @media (min-width: 1024px) {
            #sidebar {
                width: 20rem;
                /* lg:w-80 */
            }
        }

        .space-y-6>*+* {
            margin-top: 1.5rem;
            /* space-y-6 */
        }

        .space-y-10>*+* {
            margin-top: 2.5rem;
            /* space-y-10 */
        }

        .mt-10 {
            margin-top: 2.5rem;
        }

        #profile {
            margin-bottom: 2rem;
            /* mb-8 */
        }

        #profile img {
            width: 2.5rem;
            /* w-10 */
            margin-bottom: 1.5rem;
            /* mb-6 */
            border-radius: 9999px;
            /* rounded-full */
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 768px) {
            #profile img {
                width: 4rem;
                /* md:w-36 */
            }
        }

        #profile h2 {
            font-weight: 500;
            /* font-medium */
            font-size: 0.75rem;
            /* text-xs */
            text-align: center;
            color: #14b8a6;
            /* text-teal-500 */
        }

        @media (min-width: 768px) {
            #profile h2 {
                font-size: 1.25rem;
                /* md:text-xl */
            }
        }

        #profile p {
            font-size: 0.75rem;
            /* text-xs */
            color: #6b7280;
            /* text-gray-500 */
            text-align: center;
            margin-bottom: 50%;
        }

        #menu {
            display: flex;
            flex-direction: column;
            margin-top: 0.5rem;
            /* mt-2 */
        }

        #menu a {
            font-size: 1.125rem;
            /* text-lg */
            font-weight: 500;
            /* font-medium */
            padding: 0.5rem;
            /* py-2 px-2 */
            border-radius: 0.375rem;
            /* rounded-md */
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out, transform 0.15s ease-in-out;
        }

        #menu a:hover {
            background-color: #14b8a6;
            /* hover:bg-teal-500 */
            color: #ffffff;
            /* hover:text-white */
            transform: scale(1.05);
            /* hover:scale-105 */
        }

        #menu a.active {
            color: #ffffff;
            /* text-white */
            background-color: #14b8a6;
            /* bg-teal-500 */
        }

        #menu a svg {
            width: 1.5rem;
            /* w-6 */
            height: 1.5rem;
            /* h-6 */
            fill: currentColor;
            /* fill-current */
            display: inline-block;
        }

        #menu a span {
            margin-left: 0.5rem;
        }

        form button {
            display: flex;
            flex-direction: row;
            font-size: 1.125rem;
            /* text-lg */
            margin-top: 12rem;
            /* lg:mt-48 */
            font-weight: 500;
            /* font-medium */
            padding: 0.5rem;
            /* py-2 px-2 */
            border-radius: 0.375rem;
            /* rounded-md */
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out, transform 0.15s ease-in-out;
            align-items: end;
            justify-content: start;
        }

        form button:hover {
            background-color: #14b8a6;
            /* hover:bg-teal-500 */
            color: #ffffff;
            /* hover:text-white */
            transform: scale(1.05);
            /* hover:scale-105 */
        }

        form button svg {
            width: 1.5rem;
            /* w-6 */
            height: 1.5rem;
            /* h-6 */
            fill: currentColor;
            /* fill-current */
            display: inline-block;
            margin-right: 0.5rem;
        }
    </style>
</head>

<body class="font-poppins antialiased">
    <div id="view" class="h-full flex flex-row overflow-x-hidden">
        <div class="absolute top-0 left-0 mt-2 ml-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-black hover:text-teal-500 transition-transform transform hover:scale-110">
                <path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path>
                <path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path>
            </svg>
        </div>
        <div id="sidebar" class="bg-gray-300 h-screen md:block shadow-xl px-12 w-30 md:w-60 lg:w-80 overflow-x-hidden transition-transform duration-300 ease-in-out">

            <div class="space-y-6 md:space-y-10 mt-10">
                <!-- <h1 class="hidden md:block font-bold text-sm md:text-xl text-center"></h1> -->


                <div id="profile" class="space-y-3 mb-8">

                    <img src="../images/osa_logo.png" alt="Avatar user" class="w-8 md:w-36 mb-6 rounded-full mx-auto" />
                    <div>
                        <h2 class="font-medium text-xs md:text-xl text-center text-teal-500">
                            Helen Patalbo                        </h2>
                        <p class="text-xs text-gray-500 text-center" style="margin-bottom: 50%;">osa</p>
                    </div>
                </div>

                <div id="menu" class="flex flex-col space-y-3" style="margin-top: -10%;">
                    <a href="../OSA/MainDashboard.php" class="text-lg font-medium text-black-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
                        </svg>
                        <span class="text-sm">Dashboard</span>
                    </a>
                    <a href="../OSA/OSA_Profile.php" class="text-lg font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Profile</span>
                    </a>
                    <!-- <a href="../OSA/OSA_Statistics.php" class="text-lg font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 26 26">
                            <path fill="currentColor" d="M12.906-.031a1 1 0 0 0-.125.031A1 1 0 0 0 12 1v1H3a3 3 0 0 0-3 3v13c0 1.656 1.344 3 3 3h9v.375l-5.438 2.719a1.006 1.006 0 0 0 .875 1.812L12 23.625V24a1 1 0 1 0 2 0v-.375l4.563 2.281a1.006 1.006 0 0 0 .875-1.812L14 21.375V21h9c1.656 0 3-1.344 3-3V5a3 3 0 0 0-3-3h-9V1a1 1 0 0 0-1.094-1.031M2 5h22v13H2zm18.875 1a1 1 0 0 0-.594.281L17 9.563L14.719 7.28a1 1 0 0 0-1.594.219l-2.969 5.188l-1.219-3.063a1 1 0 0 0-1.656-.344l-3 3a1.016 1.016 0 1 0 1.439 1.44l1.906-1.906l1.438 3.562a1 1 0 0 0 1.812.125l3.344-5.844l2.062 2.063a1 1 0 0 0 1.438 0l4-4A1 1 0 0 0 20.875 6" />
                        </svg>
                        <span class="text-md">Statistics</span>
                    </a> -->
                    <a href="../OSA/OSA_Cases.php" class="text-lg font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M3 22q-.825 0-1.412-.587T1 20V9h2v11h17v2zm4-4q-.825 0-1.412-.587T5 16V5h5V3q0-.825.588-1.412T12 1h4q.825 0 1.413.588T18 3v2h5v11q0 .825-.587 1.413T21 18zm5-13h4V3h-4z" />
                        </svg>
                        <span class="text-sm">Cases</span>
                    </a>
                    <a href="../OSA/OSA_Monitoring.php" class="text-lg font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M18.277 8c.347.596.985 1 1.723 1a2 2 0 0 0 0-4c-.738 0-1.376.404-1.723 1H16V4a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H5.723C5.376 5.404 4.738 5 4 5a2 2 0 0 0 0 4c.738 0 1.376-.404 1.723-1H8v.369C5.133 9.84 4.318 12.534 4.091 14H3a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-.877c.197-.959.718-2.406 2.085-3.418A.984.984 0 0 0 9 11h6a.98.98 0 0 0 .792-.419c1.373 1.013 1.895 2.458 2.089 3.419H17a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-1.092c-.227-1.466-1.042-4.161-3.908-5.632V8h2.277zM6 18H4v-2h2v2zm14 0h-2v-2h2v2zm-6-9h-4V5h4v4z"></path>
                        </svg>
                        <span class="text-sm">Monitoring</span>
                    </a>
                    <a href="../OSA/OSA_SendMessage.php" class="text-lg font-medium active py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" />
                                <path d="M8.023 17.215q.05-.046.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785" />
                            </g>
                        </svg>
                        <span class="text-sm">Send Message</span>
                    </a>
                    <a href="../OSA/OSA_StudentProfile.php" class="text-lg font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9A3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42c-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3a3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3a3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.54 5.54 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13zM0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9c-.59.68-.95 1.62-.95 2.65V20zm24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65c2.56.34 4.45 1.51 4.45 2.9z" />
                        </svg>
                        <span class="text-sm">Student Profile</span>
                    </a>
                    <!-- <a href="" class="text-lg font-medium text-gray-700 py-3 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" class=" fill-current inline-block">
                            <path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path>
                            <path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path>
                        </svg>
                    </a> -->
                </div>

                <div>
                    <form action="../Login/OSA_Logout.php" method="post">
                        <button type="submit" class="flex flex-row text-lg lg:mt-48 font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out items-end justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current inline-block">
                                <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                                <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>        </div>
        <div class="flex justify-center items-center">
            <!-- component -->
<div class="w-full bg-white shadow-xl rounded-lg flex overflow-x-auto custom-scrollbar" style="width: 1598px; height: 905px;">
    <div class="w-64 px-4">
        <div class="h-16 flex items-center">
            <a href="#" id="composeButton" class="w-48 mx-auto bg-blue-600 hover:bg-blue-700 flex items-center justify-center text-gray-100 py-2 rounded space-x-2 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Compose</span>
            </a>
        </div>
        
<div id="composeWindow" class="fixed bottom-0 right-0 bg-white shadow-lg rounded-lg p-4 w-1/4 h-auto hidden">
    <div class="flex justify-between items-center border-b pb-2 mb-2">
        <h2 class="text-lg font-semibold">New Message</h2>
        <button id="closeCompose" class="text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <form method="POST" action="../phpfiles/sendmessage.php">
        <div class="mb-2">
            <input type="text" name="to" id="to" class="w-full text-gray-700 py-1 border-b border-b-gray-300 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="To">
            <div id="suggestions" class="bg-white border border-gray-300 mt-1 rounded-lg shadow-lg hidden"></div>
        </div>
        <input type="hidden" name="studentId" id="studentId"> <!-- Hidden input for StudentID -->
        <input type="hidden" name="fullName" id="fullName"> <!-- Hidden input for FullName -->
        <input type="hidden" name="fullNameSender" id="fullNameSender" value="Helen Patalbo"> 

        <div class="mb-2">
            <input type="text" name="subject" id="subject" class="w-full text-gray-700 py-1 border-b border-b-gray-300 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="Subject">
        </div>
        <div class="mt-2" style="margin-bottom: -184px;">
            <textarea name="body" id="body" class="w-full h-96 max-h-96 text-gray-700 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="Message..."></textarea>
        </div>
        <div class="flex items-center justify-between mt-0" style="margin-top: -181px; margin-bottom: 10px;">
            <div class="flex items-center space-x-1 mt-0 p-0">
                <button type="button" class="bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1 text-gray-100 hover:shadow-xl transition duration-150" onclick="insertTemplate()">Summon Template</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1 text-gray-100 hover:shadow-xl transition duration-150">Send</button>
                <button title="Attach Files" class="p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M4.222 19.778a4.983 4.983 0 0 0 3.535 1.462 4.986 4.986 0 0 0 3.536-1.462l2.828-2.829-1.414-1.414-2.828 2.829a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.829-2.828-1.414-1.414-2.829 2.828a5.006 5.006 0 0 0 0 7.071zm15.556-8.485a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0L9.879 7.051l1.414 1.414 2.828-2.829a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.829 2.828 1.414 1.414 2.829-2.828z"></path>
                        <path d="m8.464 16.95-1.415-1.414 8.487-8.486 1.414 1.415z"></path>
                    </svg>
                </button>
            </div>
            <button class="text-gray-700 hover:text-gray-900 p-1" title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                    <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
                </svg>
            </button>
        </div>
    </form>
</div>

        <style>
    .section {
        display: none;
    }
    .section:not(.hidden) {
        display: block;
    }
    .nav-link.active {
        font-weight: bold;
    }
</style>

<div class="px-2 pt-4 pb-8 border-r border-gray-300">
    <ul class="space-y-2">
        <li>
            <a id="inbox-link" class="nav-link bg-gray-500 bg-opacity-30 text-blue-600 flex items-center justify-between py-1.5 px-4 rounded cursor-pointer" data-section="inboxSection">
                <span class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <span>Inbox</span>
                </span>
                <span class="bg-sky-500 text-gray-100 font-bold px-2 py-0.5 text-xs rounded-lg">3</span>
            </a>
        </li>
        <li>
            <a class="nav-link hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer" data-section="starredSection">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
                <span>Starred</span>
            </a>
        </li>
        <li>
            <a id="sent-link" class="nav-linkss hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer" data-section="sentSection">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                <span>Sent</span>
            </a>
        </li>
        <li>
            <a id="drafts-link" class="nav-link hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center justify-between text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer" data-section="draftsSection">
                <span class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Drafts</span>
                </span>
                <span class="bg-sky-500 text-gray-100 font-bold px-2 py-0.5 text-xs rounded-lg">1</span>
            </a>
        </li>
    </ul>
</div>
    </div>
    <div class="flex-1 px-2" x-data="{ checkAll: false, filterMessages: false }">
        <div class="h-16 flex items-center justify-between">
            <div class="flex items-center">
                <div class="relative flex items-center px-0.5 space-x-0.5">
                    <input @click="checkAll = !checkAll" type="checkbox" class="focus:ring-0">
                    <button @click="filterMessages = !filterMessages">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="filterMessages" @click.away="filterMessages = false" class="bg-gray-200 shadow-2xl absolute left-0 top-6 w-32 py-2 text-gray-900 rounded z-10" style="display: none;">
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            All
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            None
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            Read
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            Unread
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            Starred
                        </button>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <button title="Reload" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>
                    <div class="flex items-center space-x-2">
                        <button title="Delete" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>
                    <div class="flex items-center space-x-2">
                        <button title="Mark As Read" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                            </svg>
                        </button>
                        <button title="Mark As Unread" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                        <button title="Add Star" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <div id="inbox-content" class="bg-gray-100 sections" style="display: block;">
            <div class="overflow-y-auto" style="max-height: 840px;">
    <ul>
        <li class="flex items-center border-y hover:bg-gray-200 px-2">
            <input type="checkbox" class="focus:ring-0 border-2 border-gray-400" :checked="checkAll">
            <div x-data="{ messageHover: false }" @mouseover="messageHover = true" @mouseleave="messageHover = false" class="w-full flex items-center justify-between p-1 my-1 cursor-pointer">
                <div class="flex items-center">
                    <div class="flex items-center mr-4 ml-1 space-x-1">
                        <button title="Not starred">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="w-56 pr-2 truncate">William Livingston</span>
                    <span class="w-64 truncate">Lorem ipsum dolor sit amet</span>
                    <span class="mx-1">-</span>
                    <span class="w-96 text-gray-600 text-sm truncate">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</span>
                </div>
                <div class="w-32 flex items-center justify-end">
                    <div x-show="messageHover" class="flex items-center space-x-2" style="display: none;">
                        <button title="Archive">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                            </svg>
                        </button>
                        <button title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                        <button title="Mark As Unread">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                    <span x-show="!messageHover" class="text-sm text-gray-500">
                        3:05 PM
                    </span>
                </div>
            </div>
        </li>
        <!-- Repeat for other messages -->
        <li class="flex items-center border-y hover:bg-gray-200 px-2">
            <input type="checkbox" class="focus:ring-0 border-2 border-gray-400" :checked="checkAll">
            <div x-data="{ messageHover: false }" @mouseover="messageHover = true" @mouseleave="messageHover = false" class="w-full flex items-center justify-between p-1 my-1 cursor-pointer">
                <div class="flex items-center">
                    <div class="flex items-center mr-4 ml-1 space-x-1">
                        <button title="Starred">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 hover:text-yellow-600 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </button>

                    </div>
                    <span class="w-56 pr-2 font-bold truncate">Betty Garmon</span>
                    <span class="w-64 font-bold truncate">Consectetur adipiscing elit</span>
                    <span class="mx-1">-</span>
                    <span class="w-96 text-gray-600 text-sm truncate">Ccusantium doloremque laudantium, totam rem aperiam, eaque ipsa</span>
                </div>
                <div class="w-32 flex items-center justify-end">
                    <div x-show="messageHover" class="flex items-center space-x-2" style="display: none;">
                        <button title="Archive">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                            </svg>
                        </button>
                        <button title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                        <button title="Mark As Read">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                            </svg>
                        </button>
                        <button title="Snooze">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <span x-show="!messageHover" class="text-sm font-bold">
                        1:23 PM
                    </span>
                </div>
            </div>
        </li>

    </ul>
</div>        </div>

        <div id="sent-content" class=" bg-gray-100 sections" style="display: none;">
            <br />
<b>Fatal error</b>:  Uncaught mysqli_sql_exception: Table 'db_connection.messages' doesn't exist in C:\xampp\htdocs\CAPSTONE\components\sent_content_osa.php:15
Stack trace:
#0 C:\xampp\htdocs\CAPSTONE\components\sent_content_osa.php(15): mysqli-&gt;prepare('SELECT * FROM m...')
#1 C:\xampp\htdocs\CAPSTONE\components\OSA_SendMessage.php(87): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\CAPSTONE\OSA\OSA_SendMessage.php(53): include('C:\\xampp\\htdocs...')
#3 {main}
  thrown in <b>C:\xampp\htdocs\CAPSTONE\components\sent_content_osa.php</b> on line <b>15</b><br />

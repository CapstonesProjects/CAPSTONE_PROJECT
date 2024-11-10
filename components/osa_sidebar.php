<?php if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    $query = "SELECT FirstName, LastName, Role FROM tblusers_osa WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
    $_SESSION['Role'] = $user['Role'];
} else {
    // Redirect to login page or show an error
} ?>

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
        @media (min-width: 1024px){ 
            #hamburger{
                display: none;
            }

            #view{
                width: 20rem; /* md:w-60 */
                position: relative; /* Keep it fixed */
            }
            #sidebar {
                width: 20rem;
                display: block;
            }

            .text-md {
                font-size: 18px; /* Adjust this size as needed */
            }
        }

        
        @media (min-width: 768px) {         
            #sidebar {
                width: 20rem; /* md:w-60 */
                position: fixed; /* Keep it fixed */
                top: 0; /* Align it to the top */
                left: 0; /* Align it to the left */
                z-index: 20; /* Higher z-index to stay on top */
                height: 100%; /* Full height */
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3); /* Optional: Add shadow for depth */
                transition: transform 0.3s ease; /* Smooth transition for opening/closing */

            }

            #sidebar.closed {
                transform: translateX(-100%); /* Move it out of view when closed */
            }

            /* Header Styles */
            #hamburger {
                position: absolute; /* Fixed position within the header */
                top: 30px; /* Spacing from the top */
                left: 10px; /* Spacing from the left */
                z-index: 40; /* Ensure it sits above the header and sidebar */
                cursor: pointer;
                font-size: 1.5rem;
                background-color: #A9A9A9; /* Set your desired background color here */
                color: white; /* Text color for contrast */
                padding: 10px; /* Padding around the icon */
                border-radius: 30px; /* Rounded corners */
                transition: background-color 0.3s ease; /* Smooth transition for background color */
            }

            .text-md {
                font-size: 15px; /* Adjust this size as needed */
            }

        }

        @media (min-width: 480px) {         
            #sidebar {
                width: 20rem; /* md:w-60 */
                position: fixed; /* Keep it fixed */
                top: 0; /* Align it to the top */
                left: 0; /* Align it to the left */
                z-index: 20; /* Higher z-index to stay on top */
                height: 100%; /* Full height */
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3); /* Optional: Add shadow for depth */
                transition: transform 0.3s ease; /* Smooth transition for opening/closing */

            }

            #sidebar.closed {
                transform: translateX(-100%); /* Move it out of view when closed */
            }

            /* Header Styles */
            #hamburger {
                position: absolute; /* Fixed position within the header */
                top: 30px; /* Spacing from the top */
                left: 10px; /* Spacing from the left */
                z-index: 40; /* Ensure it sits above the header and sidebar */
                cursor: pointer;
                font-size: 1.5rem;
                background-color: #A9A9A9; /* Set your desired background color here */
                color: white; /* Text color for contrast */
                padding: 10px; /* Padding around the icon */
                border-radius: 30px; /* Rounded corners */
                transition: background-color 0.3s ease; /* Smooth transition for background color */
            }

            .text-md {
                font-size: 12px; /* Adjust this size as needed */
            }
        }
    </style>
</head>
<div id="hamburger">☰</div>
<body class="font-poppins antialiased">
    <div id="view" class="h-full flex flex-row overflow-x-hidden">
        
        <div id="sidebar" class="bg-gray-300 h-screen md:block shadow-xl px-12 w-30 md:w-60 lg:w-80 overflow-x-hidden transition-transform duration-300 ease-in-out">
        <div class="absolute top-0 right-0 mt-2 ml-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current text-black hover:text-teal-500 transition-transform transform hover:scale-110">
                <path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path>
                <path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path>
            </svg>
        </div>
            <div class="space-y-6 md:space-y-10 mt-10">
                <!-- <h1 class="hidden md:block font-bold text-sm md:text-xl text-center"></h1> -->


                <div id="profile" class="space-y-3 mb-8">

                    <img src="../images/osa_logo.png" alt="Avatar user" class="w-8 md:w-36 mb-6 rounded-full mx-auto" />
                    <div>
                        <h2 class="font-medium text-xs md:text-xl text-center text-teal-500">
                            <?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']; ?>
                        </h2>
                        <p class="text-xs text-gray-500 text-center" style="margin-bottom: 50%;"><?php echo $_SESSION['Role'] ?></p>
                    </div>
                </div>

                <div id="menu" class="flex flex-col space-y-3" style="margin-top: -10%;">
                    <a href="../OSA/MainDashboard.php" class="text-lg font-medium <?php echo $activeMenu == 'dashboard' ? 'active' : 'text-black-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Dashboard</span>
                    </a>
                    <a href="../OSA/OSA_Profile.php" class="text-lg font-medium <?php echo $activeMenu == 'osa_profile' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Profile</span>
                    </a>
                    <!-- <a href="../OSA/OSA_Statistics.php" class="text-lg font-medium <?php echo $activeMenu == 'statistics' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 26 26">
                            <path fill="currentColor" d="M12.906-.031a1 1 0 0 0-.125.031A1 1 0 0 0 12 1v1H3a3 3 0 0 0-3 3v13c0 1.656 1.344 3 3 3h9v.375l-5.438 2.719a1.006 1.006 0 0 0 .875 1.812L12 23.625V24a1 1 0 1 0 2 0v-.375l4.563 2.281a1.006 1.006 0 0 0 .875-1.812L14 21.375V21h9c1.656 0 3-1.344 3-3V5a3 3 0 0 0-3-3h-9V1a1 1 0 0 0-1.094-1.031M2 5h22v13H2zm18.875 1a1 1 0 0 0-.594.281L17 9.563L14.719 7.28a1 1 0 0 0-1.594.219l-2.969 5.188l-1.219-3.063a1 1 0 0 0-1.656-.344l-3 3a1.016 1.016 0 1 0 1.439 1.44l1.906-1.906l1.438 3.562a1 1 0 0 0 1.812.125l3.344-5.844l2.062 2.063a1 1 0 0 0 1.438 0l4-4A1 1 0 0 0 20.875 6" />
                        </svg>
                        <span class="text-md">Statistics</span>
                    </a> -->
                    <a href="../OSA/OSA_Cases.php" class="text-lg font-medium <?php echo $activeMenu == 'cases' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M3 22q-.825 0-1.412-.587T1 20V9h2v11h17v2zm4-4q-.825 0-1.412-.587T5 16V5h5V3q0-.825.588-1.412T12 1h4q.825 0 1.413.588T18 3v2h5v11q0 .825-.587 1.413T21 18zm5-13h4V3h-4z" />
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Cases</span>
                    </a>
                    <a href="../OSA/OSA_Monitoring.php" class="text-lg font-medium <?php echo $activeMenu == 'sanctionmanagement' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M18.277 8c.347.596.985 1 1.723 1a2 2 0 0 0 0-4c-.738 0-1.376.404-1.723 1H16V4a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H5.723C5.376 5.404 4.738 5 4 5a2 2 0 0 0 0 4c.738 0 1.376-.404 1.723-1H8v.369C5.133 9.84 4.318 12.534 4.091 14H3a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-.877c.197-.959.718-2.406 2.085-3.418A.984.984 0 0 0 9 11h6a.98.98 0 0 0 .792-.419c1.373 1.013 1.895 2.458 2.089 3.419H17a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-1.092c-.227-1.466-1.042-4.161-3.908-5.632V8h2.277zM6 18H4v-2h2v2zm14 0h-2v-2h2v2zm-6-9h-4V5h4v4z"></path>
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Monitoring</span>
                    </a>
                    <a href="../OSA/OSA_Send_Message.php" class="text-lg font-medium <?php echo $activeMenu == 'send_message' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" />
                                <path d="M8.023 17.215q.05-.046.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785" />
                            </g>
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Send Message</span>
                    </a>
                    <a href="../OSA/OSA_StudentProfile.php" class="text-lg font-medium <?php echo $activeMenu == 'student_profile' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9A3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42c-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3a3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3a3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.54 5.54 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13zM0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9c-.59.68-.95 1.62-.95 2.65V20zm24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65c2.56.34 4.45 1.51 4.45 2.9z" />
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Student Profile</span>
                    </a>
                    <!-- <a href="../OSA/OSA_Events.php" class="text-lg font-medium <?php echo $activeMenu == 'events' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-1 15h-6v-6h6v6zm1-10H5V7h14v2z"></path>
                        </svg>
                        <span class="text-sm">Events</span>
                    </a> -->
                    <!-- <a href="" class="text-lg font-medium text-gray-700 py-3 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" class=" fill-current inline-block">
                            <path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path>
                            <path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path>
                        </svg>
                    </a> -->
                </div>
                <div>
                    <form action="../Login/OSA_Admin_Logout.php" method="post">
                        <button type="submit" id="logoutButton" class="flex flex-row text-lg lg:mt-48 font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out items-end justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current inline-block">
                                <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                                <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path>
                            </svg>
                            <span class="text-sm sm:text-md md:text-lg">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const button = document.getElementById('hamburger');

                // Toggle the sidebar's visibility
                if (sidebar.style.transform === "translateX(0%)") {
                    sidebar.style.transform = "translateX(-100%)"; // Hide sidebar
                    button.innerHTML = "☰"; // Change back to hamburger icon
                } else {
                    sidebar.style.transform = "translateX(0%)"; // Show sidebar
                    button.innerHTML = "⬅"; // Right arrow when sidebar is open
                }
            }
            // Initialize sidebar as visible on load
            document.addEventListener('DOMContentLoaded', () => {
                const sidebar = document.getElementById('sidebar');
                sidebar.style.transform = "translateX(0%)"; // Show sidebar on load
            });
            
            // Add event listener to the hamburger div
            document.getElementById('hamburger').addEventListener('click', toggleSidebar);
        </script>
</body>

</html>
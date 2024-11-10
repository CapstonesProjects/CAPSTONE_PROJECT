<?php

include('../config/db_connection.php');

$studentID = $_SESSION['StudentID'];

// Check if cases have been viewed
if (!isset($_SESSION['casesViewed'])) {
    $_SESSION['casesViewed'] = false;
}

// Fetch the number of cases
$query = "SELECT COUNT(*) as caseCount FROM tblcases WHERE StudentID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$caseCount = $row['caseCount'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Link to your CSS file -->
    <title>Sidebar Layout</title>


    <style>

        body {
            font-family: 'Poppins', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-size: 16px; /* or your preferred default size */
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

        .text-md {
            font-size: 18px; /* Adjust this size as needed */
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


        #profile h2 {
            font-weight: 500;
            /* font-medium */
            font-size: 0.75rem;
            /* text-xs */
            text-align: center;
            color: #14b8a6;
            /* text-teal-500 */
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
        
        @media (min-width: 1024px)
        { 
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

        
        @media (min-width: 768px) 
        {         
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

            #profile h2 {
                font-size: 1.25rem;
                /* md:text-xl */
            }

            
            #profile img {
                width: 4rem;
                /* md:w-36 */
            }

            .text-md {
                font-size: 15px; /* Adjust this size as needed */
            }


        }
            

        

        @media (max-width: 648px) 
        {   

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

<body class="font-poppins antialiased">
    <div id="hamburger">☰</div>
    <div id="view" class="h-full flex flex-row">
        <div id="sidebar" class="bg-gray-300 h-screen md:block shadow-xl px-12 w-30 md:w-60 lg:w-80 overflow-x-hidden transition-transform duration-300 ease-in-out">

            <div class="absolute top-0 right-0 mt-2 ml-4">
                <a href="" class="text-lg font-medium text-gray-700 py-3 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current inline-block">
                            <path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path>
                            <path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path>
                    </svg>
                </a>
            </div>

            <div class="space-y-6 md:space-y-10 mt-10">
                <h1 class="hidden md:block font-bold text-sm md:text-xl text-center"></h1>
                <div id="profile" class="space-y-3 mb-8">
                    <img src="../images/osa_logo.png" alt="Avatar user" class="w-8 md:w-36 mb-6 rounded-full mx-auto" />
                    <div>
                        <h2 class="font-medium text-xs md:text-xl text-center text-teal-500">
                            <?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']; ?>
                        </h2>
                        <p class="text-xs text-gray-500 text-center" style="margin-bottom: 50%;">College Student</p>
                    </div>
                </div>

                <div id="menu" class="flex flex-col space-y-3 mt-2">
                    <a href="../Student/Student_Dashboard.php" class="text-lg font-medium <?php echo $activeMenu == 'profile' ? 'active' : 'text-black-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out                 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Profile</span>
                    </a>
                    
                    <a href="../Student/Notification.php" class="text-lg font-medium <?php echo $activeMenu == 'notification' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <g fill="none">
                                <path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor" d="M12 2a7 7 0 0 0-7 7v3.528a1 1 0 0 1-.105.447l-1.717 3.433A1.1 1.1 0 0 0 4.162 18h15.676a1.1 1.1 0 0 0 .984-1.592l-1.716-3.433a1 1 0 0 1-.106-.447V9a7 7 0 0 0-7-7m0 19a3 3 0 0 1-2.83-2h5.66A3 3 0 0 1 12 21" />
                            </g>
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Notification</span>
                    </a>

                    <a href="../Student/Case.php" class="text-lg font-medium <?php echo $activeMenu == 'scholarship' ? 'active' : 'text-black-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M18 22a2 2 0 0 0 2-2V8l-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12zM13 4l5 5h-5V4zM7 8h3v2H7V8zm0 4h10v2H7v-2zm0 4h10v2H7v-2z"></path>
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Case</span>
                        <?php if ($caseCount > 0 && !$_SESSION['casesViewed']): ?>
                            <span class="ml-2 bg-red-500 text-white text-sm font-semibold px-2 py-1 rounded-full"><?php echo $caseCount; ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="../Student/Rules_Regulation.php" class="text-lg font-medium <?php echo $activeMenu == 'rules&regulation' ? 'active' : 'text-black-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M18 14h12v2H18zm0 5h8v2h-8zm0-10h12v2H18z" />
                            <path fill="currentColor" d="M22 24v4H6V16h8v-2h-4V8a4 4 0 0 1 7.668-1.6l1.832-.8A6.001 6.001 0 0 0 8 8v6H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4Z" />
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Rules&Regulation</span>
                    </a>


                    <!-- <a href="../Student/Rules_Regulation.php" class="text-lg font-medium <?php echo $activeMenu == 'rules&regulation' ? 'active' : 'text-black-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M18 14h12v2H18zm0 5h8v2h-8zm0-10h12v2H18z" />
                            <path fill="currentColor" d="M22 24v4H6V16h8v-2h-4V8a4 4 0 0 1 7.668-1.6l1.832-.8A6.001 6.001 0 0 0 8 8v6H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4Z" />
                        </svg>
                        <span class="text-sm sm:text-md md:text-lg">Rules & Regulation</span>
                    </a> -->
                          
                    
                </div>

                <div>
                    <form action="../Login/Student_Logout.php" method="post">
                        <button type="submit" class="flex flex-row text-lg lg:mt-48 font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out items-end justify-start">
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
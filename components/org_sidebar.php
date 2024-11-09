<?php if (isset($_SESSION['OrgID'])) {
    $orgId = $_SESSION['OrgID'];

    $query = "SELECT FirstName, LastName, Role FROM tblusers_organization WHERE OrgID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orgId);
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
        }

        
        @media (min-width: 768px) {         
            #sidebar {
                width: 20rem; /* md:w-60 */
                position: fixed; /* Keep it fixed */
                top: 0; /* Align it to the top */
                left: 0; /* Align it to the left */
                z-index: 20; /* Higher z-index to stay on top */
                height: 100%; /* Full height */
                background-color: #fff; /* Optional: Set a background color */
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



        }

        @media (min-width: 480px) {         
            #sidebar {
                width: 20rem; /* md:w-60 */
                position: fixed; /* Keep it fixed */
                top: 0; /* Align it to the top */
                left: 0; /* Align it to the left */
                z-index: 20; /* Higher z-index to stay on top */
                height: 100%; /* Full height */
                background-color: #fff; /* Optional: Set a background color */
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
        }

    </style>
</head>
<div id="hamburger">☰</div>
<body class="font-poppins antialiased">
    <div id="view" class="h-full flex flex-row overflow-x-hidden">
       
        <div id="sidebar" class="bg-gray-300 h-screen md:block shadow-xl px-12 w-30 md:w-60 lg:w-80 overflow-x-hidden transition-transform duration-300 ease-in-out">
        <div class="absolute top-0 left-0 mt-2 ml-4">
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
                    <a href="../ORGANIZATION/Organization_Dashboard.php" class="text-lg font-medium <?php echo $activeMenu == 'dashboard' ? 'active' : 'text-black-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
                        </svg>
                        <span class="text-sm">Dashboard</span>
                    </a>
                    <a href="../ORGANIZATION/Org_Profile.php" class="text-lg font-medium <?php echo $activeMenu == 'org_profile' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Profile</span>
                    </a>
                    <a href="../ORGANIZATION/ORG_Send_Message.php" class="text-lg font-medium <?php echo $activeMenu == 'send_message' ? 'active' : 'text-gray-700'; ?> py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="0.5em" viewBox="0 0 24 24">
                            <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" />
                                <path d="M8.023 17.215q.05-.046.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785" />
                            </g>
                        </svg>
                        <span class="text-sm">Send Message</span>
                    </a>


                </div>
                <div>
                    <form action="../Login/Org_Logout.php" method="post">
                        <button type="submit" id="logoutButton" class="flex flex-row text-lg lg:mt-48 font-medium text-gray-700 py-2 px-2 hover:bg-teal-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out items-end justify-start">
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
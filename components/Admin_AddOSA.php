<?php
include('../config/db_connection.php');

// Fetch OSA user data from the database
$query = "SELECT UserID, OSA_number, FirstName, LastName, MiddleName, Suffix, Username, Password, Role, Email, PhoneNumber, DateBirth, Gender, Nationality, MaritalStatus, Status, profile_picture, failed_attempts, lock_time FROM tblusers_osa";
$result = mysqli_query($conn, $query);
?>

<!-- component -->
<div class="antialiased sans-serif h-screen ml-0 " style="width: 1500px; padding: 0;">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="../css/student_profile2.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    <div class="container py-3 px-1 ml-12 overflow-hidden" x-data="datatables()" x-cloak>
        <div style="width: 130%;">
            <h1 class="text-3xl py-3 mb-10">OSA List</h1>
        </div>

        <div class="mb-4 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <form action="" method="post">
                        <input type="search" class="searchbar form-control me-2 w-60 mr-0 pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">
                    </form>
                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <div class="shadow rounded-lg flex justify-end mb-4" style="margin-left: 0%;">
                    <div class="relative">
                        <div class="flex justify-end">
                            <div class="flex">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600" data-bs-toggle="modal" data-bs-target="#AddOSAModal">Add OSA</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">OSA ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">First Name</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Last Name</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Email</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-300">
                            <td class="border-dashed border-t border-gray-200 userId text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['OSA_number']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 firstName text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['FirstName']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 lastName text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['LastName']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 emailAddress text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['Email']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 action text-center">
                                <div class="flex justify-center space-x-2">
                                    <button class="bg-blue-100 text-blue-800 px-2 py-1 rounded border border-blue-300 hover:bg-blue-200" data-bs-toggle="modal" data-bs-target="#OSAViewProfileModal<?php echo $row['UserID']; ?>">View</button>
                                    <button class="bg-green-100 text-green-800 px-2 py-1 rounded border border-green-300 hover:bg-green-200">Edit</button>
                                    <button class="bg-red-100 text-red-800 px-2 py-1 rounded border border-red-300 hover:bg-red-200">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php include('../modals/ViewProfileOSA.php') ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script>
        function datatables() {
            return {}
        }
    </script>
</div>
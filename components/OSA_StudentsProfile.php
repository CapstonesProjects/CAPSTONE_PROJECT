<?php
include('../config/db_connection.php');

// Fetch student data from the database
$query = "SELECT UserID, StudentID, FirstName, LastName, MiddleName, Suffix, Course, YearLevel, StudentType, Email, PhoneNumber, DateBirth, Address, Gender, Nationality, EmergencyContact, MaritalStatus, GuardiansName, GuardiansContact, Username, Status FROM tblusers_student";
$result = mysqli_query($conn, $query);
?>

<!-- component -->
<div class="antialiased sans-serif h-screen ml-0 " style="width: 1500px; padding: 0;">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="../css/student_profile2.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    <div class="container py-3 px-1 ml-12 overflow-hidden" x-data="datatables()" x-cloak>
        <div class="flex justify-between items-center" style="width: 100%;">
            <h1 class="text-3xl py-3 mb-10">Students List</h1>
            <form action="../phpfiles/add_student.php" method="POST" enctype="multipart/form-data">
                <label for="importExcel" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-lg transition duration-300 ease-in-out transform hover:scale-105 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 48 48" class="mr-2">
                        <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path>
                        <path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path>
                        <path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path>
                        <path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                    </svg>
                    Import Excel
                </label>
                <input type="file" id="importExcel" name="importExcel" accept=".xls,.xlsx" style="display: none;" onchange="this.form.submit()">
            </form>
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
                                <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded" data-bs-toggle="modal" data-bs-target="#AddStudentModal">Add Student</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative" style="height: 645px; width: 1490px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Student ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">First Name</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Last Name</th>
                        <!-- <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Email</th> -->
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Course</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-300">
                            <td class="border-dashed border-t border-gray-200 userId text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['StudentID']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 firstName text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['FirstName']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 lastName text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['LastName']; ?></span>
                            </td>
                            <!-- <td class="border-dashed border-t border-gray-200 emailAddress text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['Email']; ?></span>
                            </td> -->
                            <td class="border-dashed border-t border-gray-200 gender text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['Course']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 action text-center">
                                <div class="flex justify-center space-x-2">
                                    <button class="bg-blue-100 text-blue-800 px-2 py-1 rounded border border-blue-300 hover:bg-blue-200" data-bs-toggle="modal" data-bs-target="#OSAViewProfileModal<?php echo $row['UserID']; ?>">View</button>
                                    <button class="bg-green-100 text-green-800 px-2 py-1 rounded border border-green-300 hover:bg-green-200">Edit</button>
                                    <button class="bg-red-100 text-red-800 px-2 py-1 rounded border border-red-300 hover:bg-red-200">Delete</button>
                                </div>
                            </td>
                        </tr>




                        <?php include('../modals/ViewProfile.php') ?>
                    <?php } ?>


                </tbody>
            </table>
        </div>
    </div>

    <script>
        function datatables() {
            return {}
        }
    </script>
</div>
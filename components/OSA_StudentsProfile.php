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
        <div style="width: 130%;">
            <h1 class="text-3xl py-3 mb-10">Students List</h1>
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
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Email</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Course</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td class="border-dashed border-t border-gray-200 userId text-center">
            <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['StudentID']; ?></span>
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



    
    <!-- Modal for each student -->
    <div class="modal fade" id="OSAViewProfileModal<?php echo $row['UserID']; ?>" tabindex="-1" aria-labelledby="OSAViewProfileLabel<?php echo $row['UserID']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-gray-100">
                    <h5 class="modal-title font-bold text-lg" id="OSAViewProfileLabel<?php echo $row['UserID']; ?>">View Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-gray-50">
                    <form action="" method="POST">
                        <div class="container mx-auto p-4">
                            <!-- Basic Information Section -->
                            <div class="mb-4 p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
                                <h3 class="text-xl font-semibold mb-4 border-b pb-2">Basic Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label font-semibold"><strong>Student ID:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['StudentID']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>First Name:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['FirstName']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Last Name:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['LastName']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Middle Name:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['MiddleName']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Suffix:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Suffix']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Course:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Course']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Year Level:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['YearLevel']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Student Type:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['StudentType']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Email:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Email']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Phone Number:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['PhoneNumber']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Divider -->
                            <hr class="my-4 border-t-2 border-gray-300">
                            <!-- Personal Information Section -->
                            <div class="mb-4 p-4 border border-gray-300 rounded-lg bg-white shadow-sm">
                                <h3 class="text-xl font-semibold mb-4 border-b pb-2">Personal Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label font-semibold"><strong>Date of Birth:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['DateBirth']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Address:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Address']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Gender:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Gender']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Nationality:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['Nationality']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Emergency Contact:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['EmergencyContact']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Marital Status:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['MaritalStatus']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Guardian's Name:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['GuardiansName']; ?></p>
                                    </div>
                                    <div>
                                        <label class="form-label font-semibold"><strong>Guardian's Contact:</strong></label>
                                        <p class="bg-gray-100 p-2 rounded border"><?php echo $row['GuardiansContact']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-gray-100">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
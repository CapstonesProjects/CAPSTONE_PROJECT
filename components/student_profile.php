<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../config/db_connection.php');

// Check if the session variables are set
if (!isset($_SESSION['StudentID'])) {
    // Handle the case where the session variable is not set
    echo "Student ID is not set in the session.";
    exit;
}

// Fetch the profile picture path from the database
$student_id = $_SESSION['StudentID'];
$sql = "SELECT profile_picture FROM tblusers_student WHERE StudentID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$profile_picture = $row['profile_picture'] ? $row['profile_picture'] : 'https://i.pinimg.com/736x/10/26/73/1026734a49e1a7bdbbec411c861a69ab.jpg'; // Use a default picture if none is set
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</head>

<body>
    <div class="h-full bg-gray-200 pt-2 pl-6 pr-6 overflow-hidden">
        <div class="bg-white rounded-lg shadow-xl pb-8" style="width: 1550px; margin: 0 auto;">
            <div x-data="{ openSettings: false }" class="absolute right-12 mt-4 rounded">
                <button @click="openSettings = !openSettings" class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20" title="Settings">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
                <div x-show="openSettings" @click.away="openSettings = false" class="bg-white absolute right-0 w-40 py-2 mt-1 border border-gray-200 shadow-2xl" style="display: none;">
                    <div class="py-2 border-b">
                        <p class="text-gray-400 text-xs px-6 uppercase mb-1">Settings</p>
                        <button class="w-full flex items-center px-6 py-1.5 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Share Profile</span>
                        </button>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Block User</span>
                        </button>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">More Info</span>
                        </button>
                    </div>
                    <div class="py-2">
                        <p class="text-gray-400 text-xs px-6 uppercase mb-1">Feedback</p>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Report</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full h-[250px]">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg" class="w-full h-full rounded-tl-lg rounded-tr-lg opacity-75">
            </div>
            <div class="flex flex-col items-center -mt-20">
                <div class="relative w-40 h-40">
                    <img id="profileImage" src="<?php echo $profile_picture ?>" class="w-full h-full border-4 border-white rounded-full object-cover">
                    <form id="profilePictureForm" action="../phpfiles/upload_profile_picture.php" method="post" enctype="multipart/form-data" class="absolute bottom-0 right-0">
                        <input type="file" id="fileInput" name="profile_picture" class="hidden" accept="image/*" onchange="document.getElementById('profilePictureForm').submit()">
                        <button type="button" class="bg-gray-800 text-white p-1 rounded-full hover:bg-gray-700 absolute bottom-2 right-2 flex items-center justify-center" title="Change Profile Picture" onclick="document.getElementById('fileInput').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a2 2 0 00-2 2H8a2 2 0 00-2 2v1H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2h-2V6a2 2 0 00-2-2h-2a2 2 0 00-2-2zm0 4a4 4 0 110 8 4 4 0 010-8z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl"><?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']; ?></p>

                </div>
                <!-- <p class="text-gray-700">Senior Software Engineer at Tailwind CSS</p> -->
                <p class="text-sm text-gray-500"><?php echo $_SESSION['Course'] ?></p>
            </div>

        </div>

        <div class="flex-1 bg-white rounded-lg shadow-xl p-8 mt-4 mx-auto" style="max-width: 1550px;">
            <div class="overflow-auto max-h-96">
                <h4 class="text-2xl text-gray-900 font-bold mb-4">Basic Information</h4>
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-gray-700">
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Student ID:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['StudentID'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">First Name:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['FirstName'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Last Name:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['LastName'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Middle Name:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['MiddleName'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Suffix:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['Suffix'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Course:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['Course'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Year Level:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['YearLevel'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Student Type:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['StudentType'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Email:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['Email'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Phone Number:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['PhoneNumber'] ?></span>
                    </li>
                </ul>

                <div class="border-t border-gray-300 my-8"></div>

                <h4 class="text-2xl text-gray-900 font-bold mb-4">Personal Information</h4>
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-gray-700">
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Date of Birth:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['DateBirth'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Address:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['Address'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Gender:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['Gender'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Nationality:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['Nationality'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Emergency Contact:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['EmergencyContact'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Marital Status:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['MaritalStatus'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Guardian's Name:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['GuardiansName'] ?></span>
                    </li>
                    <li class="flex flex-col border p-4 rounded-lg shadow-sm bg-gray-50">
                        <span class="font-bold text-gray-900">Guardian's Contact:</span>
                        <span class="text-gray-700"><?php echo $_SESSION['GuardiansContact'] ?></span>
                    </li>
                </ul>
            </div>
        </div>


    </div>


</body>

</html>
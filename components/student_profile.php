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
$profile_picture = $row['profile_picture'] ? $row['profile_picture'] : 'https://i.pinimg.com/736x/10/26/73/1026734a49e1a7bdbbec411c861a69ab.jpg'; 


?>
<!DOCTYPE html>
<html lang="en">

<style>
    .custom-div {
        overflow: auto;
        max-height: 100%; /* Default max-height */
        max-width: 100%;   /* Default max-width */
    }

    @media (max-width: 1040px) {
        .custom-div {
            max-width:  80rem; 
            width: 34rem;/* Tailwind's sm:max-w-md */
        }
    }

    @media (max-width: 648px) {
        .custom-div {
            max-width: 38rem; 
            width: 35rem;/* Tailwind's md:max-w-5xl */
            overflow: hidden;
        }

        .mb-4{
            text-align: center;
        }

        .mb-2{
            text-align: left;

        }

        input[type="text"] {
            width: 100%;
            padding: 0rem;
        }

        .bg-white.rounded-lg.shadow-xl.pb-8 {
            max-width: 41rem;
            width: 40rem;
            overflow: hidden;
            margin: 0 auto;
        }

        .prof-bg {
            height: 156px;;
        }
        .cover {
            width: 40rem;
        }
        .bg-profile {
            max-width: 34rem;
            overflow-x: hidden;
        }
    }
</style>

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
        <div class="custom-div">
        <div class="bg-white rounded-lg shadow-xl pb-8" style="width: 1550px; margin: 0 auto;">
            <div class="w-full prof-bg h-[250px]">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg" class="cover w-full h-full rounded-tl-lg rounded-tr-lg opacity-75">
            </div>
            <div class="flex flex-col items-center -mt-20 bg-profile">
                <div class="relative w-40 h-40">
                    <img id="profileImage" src="<?php echo $profile_picture ?>" class="w-full h-full border-4 border-white rounded-full object-cover absolute">
                    <form id="profilePictureForm" action="../phpfiles/upload_profile_picture.php" method="post" enctype="multipart/form-data" class="absolute inset-0 flex items-center justify-center">
                        <input type="file" id="fileInput" name="profile_picture" class="hidden" accept="image/*" onchange="document.getElementById('profilePictureForm').submit()">
                        <div class="w-full h-full group hover:bg-gray-200 opacity-60 rounded-full absolute flex justify-center items-center cursor-pointer transition duration-500" onclick="document.getElementById('fileInput').click()">
                            <img class="hidden group-hover:block w-12" src="https://www.svgrepo.com/show/33565/upload.svg" alt="Upload Icon">
                        </div>
                    </form>
                </div>
                <div class="flex items-center space-x-2 mt-2 ">
                    <p class="text-2xl"><?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']; ?></p>
                </div>
                <p class="text-sm text-gray-500"><?php echo $_SESSION['Course'] ?></p>
            </div>
        </div>
        </div>


    <div class="custom-div">
        <div class="flex-1 bg-white rounded-lg shadow-xl p-8 mt-4 mx-auto" style="max-width: 1550px;">
    <div class="overflow-auto max-h-96">
        <h4 class="text-2xl text-gray-900 font-bold mb-4">Basic Information</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Student ID:</label>
                <input type="text" value="<?php echo $_SESSION['StudentID'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">First Name:</label>
                <input type="text" value="<?php echo $_SESSION['FirstName'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Last Name:</label>
                <input type="text" value="<?php echo $_SESSION['LastName'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Middle Name:</label>
                <input type="text" value="<?php echo $_SESSION['MiddleName'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Suffix:</label>
                <input type="text" value="<?php echo $_SESSION['Suffix'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Course:</label>
                <input type="text" value="<?php echo $_SESSION['Course'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Year Level:</label>
                <input type="text" value="<?php echo $_SESSION['YearLevel'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Student Type:</label>
                <input type="text" value="<?php echo $_SESSION['StudentType'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="text" value="<?php echo $_SESSION['Email'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                <input type="text" value="<?php echo $_SESSION['PhoneNumber'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
        </div>

        <div class="border-t border-gray-300 my-8"></div>

        <h4 class="text-2xl text-gray-900 font-bold mb-4">Personal Information</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Date of Birth:</label>
                <input type="text" value="<?php echo $_SESSION['DateBirth'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
                <input type="text" value="<?php echo $_SESSION['Address'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Gender:</label>
                <input type="text" value="<?php echo $_SESSION['Gender'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nationality:</label>
                <input type="text" value="<?php echo $_SESSION['Nationality'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Emergency Contact:</label>
                <input type="text" value="<?php echo $_SESSION['EmergencyContact'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Marital Status:</label>
                <input type="text" value="<?php echo $_SESSION['MaritalStatus'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Guardian's Name:</label>
                <input type="text" value="<?php echo $_SESSION['GuardiansName'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Guardian's Contact:</label>
                <input type="text" value="<?php echo $_SESSION['GuardiansContact'] ?>" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed" readonly>
            </div>
        </div>
    </div>


    </div>
    </div>


</body>

</html>
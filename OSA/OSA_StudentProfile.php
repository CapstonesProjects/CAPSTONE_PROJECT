<?php
session_start();
include('../config/db_connection.php');

$query = "SELECT UserID, StudentID, FirstName, LastName, MiddleName, Suffix, Course, YearLevel, StudentType, Email, PhoneNumber, DateBirth, Address, Gender, Nationality, EmergencyContact, MaritalStatus, GuardiansName, GuardiansContact, Username, Status FROM tblusers_student";
$result = mysqli_query($conn, $query);

if ($result) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

include('../modals/AddStudentModal_OSA.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>OSA Student Profile - LOA OSA</title>
</head>

<style>
     .custom-div {
        overflow: auto;
        max-height: 100%; /* Default max-height */
        max-width: 100%;   /* Default max-width */
    }
    @media (max-width: 1040px) {
        .custom-div {
            max-width:  80rem; /* Tailwind's sm:max-w-md */
        }
    }

    @media (max-width: 648px) {
        .custom-div {
            max-width: 40rem; /* Tailwind's md:max-w-5xl */
        }

        .antialiased.sans-serif.h-screen.ml-0 {
                width: 100%;
                padding: 10px;
                box-sizing: border-box;
        }

        .overflow-x-auto.bg-white.rounded-lg.shadow.overflow-y-auto.relative {
            max-height: 100%;
            max-width: 36rem; 
        }

        .container{
            max-height: fit-content;
        }
        
        .searchbar{
            max-width: 20rem;
        }

        .AddStudent{
            position: right;
        }


    }

</style>
<div class="custom-div">
<body class="font-poppins antialiased">
    <!-- Define the SVG symbol -->
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm.93 4.418a.5.5 0 0 1 .07.707L8.707 6.5l.293.293a.5.5 0 0 1-.707.707L8 7.207l-.293.293a.5.5 0 0 1-.707-.707L7.293 6.5 7 6.207a.5.5 0 0 1 .707-.707L8 5.793l.293-.293a.5.5 0 0 1 .637-.082zM8 8.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5zm0 4a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-1 0v-.5a.5.5 0 0 1 .5-.5z" />
        </symbol>
    </svg>

    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'student_profile';
            include('../components/osa_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            <?php
            include('../components/OSA_StudentsProfile.php');
            ?>
        </div>
    </div>

    <?php include('../alerts/adding_student_alerts.php'); ?>
</body>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../javascript/sessionmessage.js"></script>
<script src="../javascript/active.js"></script>
<script src="../javascript/searchbar.js"></script>
<script src="../javascript/alerts.js"></script>

</html>
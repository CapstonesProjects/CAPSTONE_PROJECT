<?php
session_start();
include('../config/db_connection.php');


if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    $query = "SELECT FirstName, LastName FROM tblusers_student WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
} else {
    // Redirect to login page or show an error
}

// $activeMenu = 'dashboard';
// include('./components/sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/student_profile.css">
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <title>Student Notification - LOA OSA</title>
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

    @media only screen and (min-width: 350px)  and (max-width: 768px) {
        .custom-div {
            max-width: 36rem; /* Tailwind's md:max-w-5xl */
        }   
        
        .flex{
            max-width: 41rem; 
        }
        .check {
            display: none;
        }

        .star {
            display: none;
        }
        .dedi-container {
            width: 100%;
        }

        #inbox-content {
            width: auto;
            max-width: 25rem;
            overflow-x: hidden;
        }

    }
</style>

<!-- <div class="custom-div"> -->
<body class="font-poppins antialiased bg-gray-200">
    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'notification';
            include('../components/student_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            <?php include('../components/notification_student.php') ?>
        </div>
    </div>
    <?php #include("../modals/Student_SettingsModal.php"); ?>
    <?php include('../alerts/changepassword_alerts.php'); ?>
</body>
<!-- </div> -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../javascript/sessionmessage.js"></script>
<script src="../javascript/active.js"></script>
<script src="../javascript/student_inbox.js"></script>
<script src="../javascript/alerts.js"></script>

</html>
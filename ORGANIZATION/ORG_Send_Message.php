<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../config/db_connection.php');

if (isset($_SESSION['OrgID'])) {
    $orgId = $_SESSION['OrgID'];

    $query = "SELECT FirstName, LastName FROM tblusers_organization WHERE OrgID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orgId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
} else {
    // Redirect to login page or show an error
    header("Location: login.php");
    exit();
}

include('../alerts/send_message.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/student_profile.css">
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <title>OSA Send Message - LOA OSA</title>
</head>

<body class="font-poppins antialiased bg-gray-200">
    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'send_message';
            include('../components/org_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            <?php include('../components/ORG_SendMessage.php') ?>
        </div>
    </div>
    <?php include('../alerts/changepassword_alerts.php') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- <script src="../javascript/sessionmessage.js"></script> -->
<script src="../javascript/active.js"></script>
<script src="../javascript/message_template.js"></script>
<script src="../javascript/org_message_sudg.js"></script>
<!-- <script src="../javascript/osa_sidebar.js"></script> -->

</body>
</html>
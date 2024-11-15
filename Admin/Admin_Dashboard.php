<?php
session_start();
include('../config/db_connection.php');


if (isset($_SESSION['AdminID'])) {
    $userId = $_SESSION['AdminID'];

    $query = "SELECT FirstName, LastName FROM admin WHERE AdminID = ?";
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
// Fetch the current semester
$query_current_semester = "SELECT Name FROM semesters WHERE IsCurrent = 1";
$result_current_semester = $conn->query($query_current_semester);
$current_semester = $result_current_semester->fetch_assoc()['Name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin Dashboard - LOA OSA</title>

    <style>
        body {
            font-family: 'IBM Plex Mono', sans-serif;
        }

        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body class="font-poppins antialiased bg-white">
    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'dashboard';
            include('../components/admin_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            <?php include('../components/Charts.php') ?>
        </div>
    </div>

    <?php include('../alerts/changepassword_alerts.php') ?>
    <?php include('../alerts/school_year_alerts.php') ?>
    <?php include('../alerts/semester_alert.php') ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../javascript/sessionmessage.js"></script>
<script src="../javascript/active.js"></script>
<script src="../javascript/charts.js"></script>
<script src="../javascript/alerts.js"></script>

</html>
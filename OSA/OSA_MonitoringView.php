<?php
session_start(); // Start the session
include('../config/db_connection.php');

if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    $query = "SELECT FirstName, LastName FROM tblusers_osa WHERE UserID = ?";
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
include('../alerts/update_case_status_alerts.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/output.css">
    <!-- <link rel="stylesheet" href="../css/styles.css"> -->
    <!-- <link rel="stylesheet" href="../css/style2.css"> -->
    <!-- <link rel="stylesheet" href="../css/student_profile.css"> -->
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>OSA Cases - LOA OSA</title>
</head>





<body class="font-poppins antialiased ">

    <div class="flex h-screen ">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'sanctionmanagement';
            include('../components/osa_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
           <?php include('../components/MonitoringViewComponent.php'); ?>
        </div>
    </div>

    <?php include('../alerts/changepassword_alerts.php'); ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../javascript/sessionmessage.js"></script>
<script src="../javascript/active.js"></script>
<script src="../javascript/searchbar.js"></script>
<script src="../javascript/saction_offense_counting.js"></script>
<script src="../javascript/autogenerate_field.js"></script>
<script src="../javascript/offenses.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script src="../javascript/alerts.js"></script>
<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const form = document.querySelector('form');
    //     form.addEventListener('submit', function () {
    //         const submitButton = form.querySelector('button[type="submit"]');
    //         submitButton.disabled = true;
    //     });
    // });
</script>

</html>
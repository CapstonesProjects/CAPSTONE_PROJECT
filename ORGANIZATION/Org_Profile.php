<?php
session_start();
include('../config/db_connection.php');


if (isset($_SESSION['OrgID'])) {
    $orgId = $_SESSION['OrgID'];

    $query = "SELECT * FROM tblusers_organization WHERE OrgID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orgId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
    $_SESSION['MiddleName'] = $user['MiddleName'];
    $_SESSION['OSA_number'] = $user['Org_number'];
    $_SESSION['Suffix'] = $user['Suffix'];
    $_SESSION['Email'] = $user['Email'];
    $_SESSION['PhoneNumber'] = $user['PhoneNumber'];
    $_SESSION['DateBirth'] = $user['DateBirth'];
    $_SESSION['Gender'] = $user['Gender'];
    $_SESSION['Nationality'] = $user['Nationality'];
    $_SESSION['MaritalStatus'] = $user['MaritalStatus'];
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
    <title>OSA Profile - LOA OSA</title>
</head>

<body class="font-poppins antialiased">
    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'org_profile';
            include('../components/org_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
        <?php
            include('../components/org_profile.php');
            ?>
        </div>
    </div>

    <?php include('../alerts/profile_image_change_alerts.php'); ?>
    <?php include('../alerts/file_large_alerts.php'); ?>
    <?php include('../alerts/changepassword_alerts.php') ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- <script src="../javascript/session_message_osa.js"></script> -->
<script src="../javascript/active.js"></script>

</html>
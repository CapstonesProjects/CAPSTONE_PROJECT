<?php
session_start();
include('./config/db_connection.php');

// Display session messages
if (isset($_SESSION['error'])) {
    echo "<div class='alert' id='error-message' style='padding: 20px; margin-bottom: 20px; color: black; background-color: #FF6868; border: 1px solid #DCFFB7; border-radius: 4px;'>";
    echo $_SESSION['error'];
    echo "</div>";
    unset($_SESSION['error']);
} else {
    echo "<div class='alert' id='error-message' style='padding: 20px; margin-bottom: 20px; color: black; background-color: #FF6868; border: 1px solid #DCFFB7; border-radius: 4px; display: none;'>";
    echo "No error message set.";
    echo "</div>";
}


// $activeMenu = 'dashboard';
// include('./components/sidebar.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/login_form.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Student Login - LOA OSA</title>
</head>

<body>
    <?php
        include('./components/header.php');
    ?>

    <?php
        include('./components/student_login_form.php');
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="./javascript/sessionmessage.js"></script>
<script src="./javascript/active.js"></script>
</html>

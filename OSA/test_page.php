<?php
session_start();
include('../config/db_connection.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <title>OSA Send Message - LOA OSA</title>
</head>

<body>

    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'send_message';
            include('../components/osa_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="../javascript/sessionmessage.js"></script>
</body>

</html>
<?php
include('./config/db_connection.php');
session_start();
session_destroy();
session_start();
$_SESSION['logout_success'] = 'You have successfully logged out!';
header('Location: ../index.php');
exit;
?>
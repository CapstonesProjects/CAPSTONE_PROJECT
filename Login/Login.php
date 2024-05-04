<?php
session_start();
include('../config/db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM tblUsers WHERE Username = ? AND Password = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
    // Login successful. Store the UserID.
    $_SESSION['UserID'] = $user['UserID'];
    $_SESSION['success'] = 'You have successfully logged in!';
    header('Location: ../MainDashboard.php');
} else {
    // Invalid username or password
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: ../index.php');
}


?>
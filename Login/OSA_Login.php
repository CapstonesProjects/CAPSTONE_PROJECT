<?php
session_start();
include('../config/db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM tblusers_osa WHERE Username = ? AND Password = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
    // Login successful. Store the UserID and OSA_number.
    $_SESSION['UserID'] = $user['UserID'];
    $_SESSION['OSA_number'] = $user['OSA_number']; // Store OSA_number in session
    $_SESSION['login_success'] = 'You have successfully logged in!';
    // Optional: Add a small delay to simulate loading
    sleep(2);
    header('Location: ../OSA/MainDashboard.php');
    exit;
} else {
    // Invalid username or password
    $_SESSION['login_error'] = 'Invalid username or password';
    header('Location: ../OSA_Index.php');
    exit;
}
?>
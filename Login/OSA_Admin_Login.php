<?php
session_start();
include('../config/db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql_osa = "SELECT * FROM tblusers_osa WHERE Username = ? AND Password = ?";
$stmt_osa = mysqli_prepare($conn, $sql_osa);
mysqli_stmt_bind_param($stmt_osa, "ss", $username, $password);
mysqli_stmt_execute($stmt_osa);
$result_osa = mysqli_stmt_get_result($stmt_osa);

if ($user_osa = mysqli_fetch_assoc($result_osa)) {
    $_SESSION['UserID'] = $user_osa['UserID'];
    $_SESSION['OSA_number'] = $user_osa['OSA_number']; 
    $_SESSION['Role'] = $user_osa['Role']; 
    $_SESSION['login_success'] = 'You have successfully logged in!';
    header('Location: ../OSA/MainDashboard.php');
    exit;
}

$sql_admin = "SELECT * FROM admin WHERE Username = ? AND Password = ?";
$stmt_admin = mysqli_prepare($conn, $sql_admin);
mysqli_stmt_bind_param($stmt_admin, "ss", $username, $password);
mysqli_stmt_execute($stmt_admin);
$result_admin = mysqli_stmt_get_result($stmt_admin);

if ($user_admin = mysqli_fetch_assoc($result_admin)) {
    $_SESSION['AdminID'] = $user_admin['AdminID'];
    $_SESSION['AdminNumber'] = $user_admin['AdminNumber']; 
    $_SESSION['Role'] = $user_admin['Role']; 
    $_SESSION['login_success'] = 'You have successfully logged in!';
    header('Location: ../Admin/Admin_Dashboard.php');
    exit;
}

$_SESSION['login_error'] = 'Invalid username or password';
header('Location: ../admin_osa_index.php');
exit;
?>
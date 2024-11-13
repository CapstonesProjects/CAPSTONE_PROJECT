<?php
session_start();
include('../config/db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

// Function to handle failed login attempts
function handle_failed_attempts($conn, $user, $userType) {
    $failedAttempts = $user['failed_attempts'] + 1;
    $lockTime = NULL;

    if ($failedAttempts >= 3) {
        $lockTime = date('Y-m-d H:i:s');
    }

    $sql = "UPDATE $userType SET failed_attempts = ?, lock_time = ? WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isi", $failedAttempts, $lockTime, $user['UserID']);
    mysqli_stmt_execute($stmt);

    $_SESSION['login_attempts'] = $failedAttempts;
    $_SESSION['login_email'] = $user['Email'];
    $_SESSION['login_username'] = $user['Username'];
    $_SESSION['login_error'] = 'Invalid username or password';
    header('Location: ../admin_osa_index.php');
    exit;
}

// Function to handle successful login
function handle_successful_login($user, $userType) {
    // Clear session variables related to login attempts
    unset($_SESSION['login_attempts']);
    unset($_SESSION['login_email']);
    unset($_SESSION['login_username']);

    // Set session variables
    $_SESSION['UserID'] = $user['UserID'];
    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
    $_SESSION['Role'] = $user['Role'];
    $_SESSION['Email'] = $user['Email'];
    $_SESSION['login_success'] = 'You have successfully logged in!';

    if ($userType == 'tblusers_osa') {
        $_SESSION['OSA_number'] = $user['OSA_number'];
        header('Location: ../OSA/MainDashboard.php');
    } else {
        $_SESSION['AdminID'] = $user['AdminID'];
        $_SESSION['AdminNumber'] = $user['AdminNumber'];
        header('Location: ../Admin/Admin_Dashboard.php');
    }
    exit;
}

// Check OSA users
$sql_osa = "SELECT * FROM tblusers_osa WHERE Username = ?";
$stmt_osa = mysqli_prepare($conn, $sql_osa);
mysqli_stmt_bind_param($stmt_osa, "s", $username);
mysqli_stmt_execute($stmt_osa);
$result_osa = mysqli_stmt_get_result($stmt_osa);

if ($user_osa = mysqli_fetch_assoc($result_osa)) {
    // Check if the account is locked
    if ($user_osa['failed_attempts'] >= 3) {
        $lockTime = strtotime($user_osa['lock_time']);
        $currentTime = time();
        $timeDifference = $currentTime - $lockTime;

        if ($timeDifference < 86400) { // 24 hours in seconds
            $_SESSION['login_error'] = 'Your account is locked. Please try again after 24 hours.';
            $_SESSION['login_attempts'] = $user_osa['failed_attempts'];
            $_SESSION['login_email'] = $user_osa['Email'];
            $_SESSION['login_username'] = $username;
            header('Location: ../admin_osa_index.php');
            exit;
        } else {
            // Reset failed attempts after 24 hours
            $sql = "UPDATE tblusers_osa SET failed_attempts = 0, lock_time = NULL WHERE UserID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_osa['UserID']);
            mysqli_stmt_execute($stmt);
        }
    }

    // Verify the password
    if ($password === $user_osa['Password']) { // Direct comparison since passwords are not hashed
        handle_successful_login($user_osa, 'tblusers_osa');
    } else {
        handle_failed_attempts($conn, $user_osa, 'tblusers_osa');
    }
}

// Check Admin users
$sql_admin = "SELECT * FROM admin WHERE Username = ?";
$stmt_admin = mysqli_prepare($conn, $sql_admin);
mysqli_stmt_bind_param($stmt_admin, "s", $username);
mysqli_stmt_execute($stmt_admin);
$result_admin = mysqli_stmt_get_result($stmt_admin);

if ($user_admin = mysqli_fetch_assoc($result_admin)) {
    // Check if the account is locked
    if ($user_admin['failed_attempts'] >= 3) {
        $lockTime = strtotime($user_admin['lock_time']);
        $currentTime = time();
        $timeDifference = $currentTime - $lockTime;

        if ($timeDifference < 86400) { // 24 hours in seconds
            $_SESSION['login_error'] = 'Your account is locked. Please try again after 24 hours.';
            $_SESSION['login_attempts'] = $user_admin['failed_attempts'];
            $_SESSION['login_email'] = $user_admin['Email'];
            $_SESSION['login_username'] = $username;
            header('Location: ../admin_osa_index.php');
            exit;
        } else {
            // Reset failed attempts after 24 hours
            $sql = "UPDATE admin SET failed_attempts = 0, lock_time = NULL WHERE AdminID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_admin['AdminID']);
            mysqli_stmt_execute($stmt);
        }
    }

    // Verify the password
    if ($password === $user_admin['Password']) { // Direct comparison since passwords are not hashed
        handle_successful_login($user_admin, 'admin');
    } else {
        handle_failed_attempts($conn, $user_admin, 'admin');
    }
}

$_SESSION['login_error'] = 'Invalid username or password';
header('Location: ../admin_osa_index.php');
exit;
?>
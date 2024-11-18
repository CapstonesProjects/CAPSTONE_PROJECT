<?php
session_start();
include('../config/db_connection.php');

// Set the time zone to Philippine time
date_default_timezone_set('Asia/Manila');

$username = $_POST['username'];
$password = $_POST['password'];

// Function to handle failed login attempts
function handle_failed_attempts($conn, $user, $userType) {
    $failedAttempts = max(0, $user['failed_attempts'] + 1); // Ensure failed attempts do not go negative
    $lockTime = NULL;

    if ($failedAttempts >= 3) {
        $lockTime = date('Y-m-d H:i:s');
    }

    if ($userType == 'tblusers_osa') {
        $sql = "UPDATE tblusers_osa SET failed_attempts = ?, lock_time = ? WHERE UserID = ?";
    } else {
        $sql = "UPDATE admin SET failed_attempts = ?, lock_time = ? WHERE AdminID = ?";
    }

    $stmt = mysqli_prepare($conn, $sql);
    if ($userType == 'tblusers_osa') {
        mysqli_stmt_bind_param($stmt, "isi", $failedAttempts, $lockTime, $user['UserID']);
    } else {
        mysqli_stmt_bind_param($stmt, "isi", $failedAttempts, $lockTime, $user['AdminID']);
    }
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
    if ($userType == 'tblusers_osa') {
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['UserType'] = 'osa';
    } else {
        $_SESSION['UserID'] = $user['AdminID'];
        $_SESSION['UserType'] = 'admin';
    }
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

        if ($timeDifference < 600) { // 10 minutes in seconds
            $_SESSION['login_error'] = 'Your account is locked. Please try again after 10 minutes.';
            $_SESSION['login_attempts'] = $user_osa['failed_attempts'];
            $_SESSION['login_email'] = $user_osa['Email'];
            $_SESSION['login_username'] = $username;
            header('Location: ../admin_osa_index.php');
            exit;
        } else {
            // Reset failed attempts after 10 minutes
            $sql = "UPDATE tblusers_osa SET failed_attempts = 0, lock_time = NULL WHERE UserID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_osa['UserID']);
            mysqli_stmt_execute($stmt);
            $user_osa['failed_attempts'] = 0; // Reset the failed attempts in the user array
        }
    }

    // Verify the password
    if (password_verify($password, $user_osa['Password'])) { // Verify the hashed password
        handle_successful_login($user_osa, 'tblusers_osa');
    } else {
        // Check if the password is plain text and needs to be hashed
        if ($user_osa['Password'] === $password) {
            // Hash the plain text password and update the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE tblusers_osa SET Password = ? WHERE UserID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $user_osa['UserID']);
            mysqli_stmt_execute($stmt);

            // Verify the hashed password
            if (password_verify($password, $hashedPassword)) {
                handle_successful_login($user_osa, 'tblusers_osa');
            }
        } else {
            handle_failed_attempts($conn, $user_osa, 'tblusers_osa');
        }
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

        if ($timeDifference < 600) { // 10 minutes in seconds
            $_SESSION['login_error'] = 'Your account is locked. Please try again after 10 minutes.';
            $_SESSION['login_attempts'] = $user_admin['failed_attempts'];
            $_SESSION['login_email'] = $user_admin['Email'];
            $_SESSION['login_username'] = $username;
            header('Location: ../admin_osa_index.php');
            exit;
        } else {
            // Reset failed attempts after 10 minutes
            $sql = "UPDATE admin SET failed_attempts = 0, lock_time = NULL WHERE AdminID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_admin['AdminID']);
            mysqli_stmt_execute($stmt);
            $user_admin['failed_attempts'] = 0; // Reset the failed attempts in the user array
        }
    }

    // Verify the password
    if (password_verify($password, $user_admin['Password'])) { // Verify the hashed password
        handle_successful_login($user_admin, 'admin');
    } else {
        // Check if the password is plain text and needs to be hashed
        if ($user_admin['Password'] === $password) {
            // Hash the plain text password and update the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE admin SET Password = ? WHERE AdminID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $user_admin['AdminID']);
            mysqli_stmt_execute($stmt);

            // Verify the hashed password
            if (password_verify($password, $hashedPassword)) {
                handle_successful_login($user_admin, 'admin');
            }
        } else {
            handle_failed_attempts($conn, $user_admin, 'admin');
        }
    }
}

$_SESSION['login_error'] = 'Invalid username or password';
header('Location: ../admin_osa_index.php');
exit;
?>
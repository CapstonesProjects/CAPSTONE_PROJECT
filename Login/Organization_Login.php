<?php
session_start();
include('../config/db_connection.php');

// Set the time zone to Philippine time
date_default_timezone_set('Asia/Manila');

$username = $_POST['username'];
$password = $_POST['password'];

// Function to handle failed login attempts
function handle_failed_attempts($conn, $user) {
    $failedAttempts = max(0, $user['failed_attempts'] + 1); // Ensure failed attempts do not go negative
    $lockTime = NULL;

    if ($failedAttempts >= 3) {
        $lockTime = date('Y-m-d H:i:s');
    }

    $sql = "UPDATE tblusers_organization SET failed_attempts = ?, lock_time = ? WHERE OrgID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isi", $failedAttempts, $lockTime, $user['OrgID']);
    mysqli_stmt_execute($stmt);

    $_SESSION['login_attempts'] = $failedAttempts;
    $_SESSION['login_email'] = $user['Email'];
    $_SESSION['login_username'] = $user['Username'];
    $_SESSION['login_error'] = 'Invalid username or password';
    header('Location: ../Org_Index.php');
    exit;
}

// Function to handle successful login
function handle_successful_login($user) {
    // Clear session variables related to login attempts
    unset($_SESSION['login_attempts']);
    unset($_SESSION['login_email']);
    unset($_SESSION['login_username']);

    // Set session variables
    $_SESSION['OrgID'] = $user['OrgID'];
    $_SESSION['Org_number'] = $user['Org_number'];
    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
    $_SESSION['Role'] = $user['Role'];
    $_SESSION['Email'] = $user['Email'];
    $_SESSION['login_success'] = 'You have successfully logged in!';

    header('Location: ../ORGANIZATION/Organization_Dashboard.php');
    exit;
}

$sql = "SELECT * FROM tblusers_organization WHERE Username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
    // Check if the account is locked
    if ($user['failed_attempts'] >= 3) {
        $lockTime = strtotime($user['lock_time']);
        $currentTime = time();
        $timeDifference = $currentTime - $lockTime;

        if ($timeDifference < 600) { // 10 minutes in seconds
            $_SESSION['login_error'] = 'Your account is locked. Please try again after 10 minutes.';
            $_SESSION['login_attempts'] = $user['failed_attempts'];
            $_SESSION['login_email'] = $user['Email'];
            $_SESSION['login_username'] = $username;
            header('Location: ../Org_Index.php');
            exit;
        } else {
            // Reset failed attempts after 10 minutes
            $sql = "UPDATE tblusers_organization SET failed_attempts = 0, lock_time = NULL WHERE OrgID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user['OrgID']);
            mysqli_stmt_execute($stmt);
            $user['failed_attempts'] = 0; // Reset the failed attempts in the user array
        }
    }

    // Verify the password
    if (password_verify($password, $user['Password'])) { // Verify the hashed password
        handle_successful_login($user);
    } else {
        // Check if the password is plain text and needs to be hashed
        if ($user['Password'] === $password) {
            // Hash the plain text password and update the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE tblusers_organization SET Password = ? WHERE OrgID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $user['OrgID']);
            mysqli_stmt_execute($stmt);

            // Verify the hashed password
            if (password_verify($password, $hashedPassword)) {
                handle_successful_login($user);
            }
        } else {
            handle_failed_attempts($conn, $user);
        }
    }
} else {
    // Invalid username
    $_SESSION['login_error'] = 'Invalid username or password';
    $_SESSION['login_username'] = $username;
    header('Location: ../Org_Index.php');
    exit;
}
?>
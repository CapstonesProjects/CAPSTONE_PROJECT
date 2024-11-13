<?php
session_start();
include('../config/db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

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

        if ($timeDifference < 86400) { // 24 hours in seconds
            $_SESSION['login_error'] = 'Your account is locked. Please try again after 24 hours.';
            $_SESSION['login_attempts'] = $user['failed_attempts'];
            $_SESSION['login_email'] = $user['Email'];
            $_SESSION['login_username'] = $username;
            header('Location: ../Org_Index.php');
            exit;
        } else {
            // Reset failed attempts after 24 hours
            $sql = "UPDATE tblusers_organization SET failed_attempts = 0, lock_time = NULL WHERE OrgID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user['OrgID']);
            mysqli_stmt_execute($stmt);
        }
    }

    // Verify the password
    if ($password === $user['Password']) { // Direct comparison since passwords are not hashed
        // Login successful. Reset failed attempts.
        $sql = "UPDATE tblusers_organization SET failed_attempts = 0, lock_time = NULL WHERE OrgID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user['OrgID']);
        mysqli_stmt_execute($stmt);

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
        
        header('Location: ../Organization/Organization_Dashboard.php');
        exit;
    } else {
        // Increment failed attempts
        $failedAttempts = $user['failed_attempts'] + 1;
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
        $_SESSION['login_username'] = $username;
        $_SESSION['login_error'] = 'Invalid username or password';
        header('Location: ../Org_Index.php');
        exit;
    }
} else {
    // Invalid username
    $_SESSION['login_error'] = 'Invalid username or password';
    $_SESSION['login_username'] = $username;
    header('Location: ../Org_Index.php');
    exit;
}
?>
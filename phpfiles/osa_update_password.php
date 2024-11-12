<?php
session_start();
include('../config/db_connection.php');

if (!isset($_SESSION['UserID'])) {
    $_SESSION['error'] = "You must be logged in to change your password.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "New password and confirm password do not match.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $studentId = $_SESSION['UserID'];

    $sql = "SELECT Password FROM tblusers_osa WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $_SESSION['error'] = "Database error: Failed to prepare statement.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "s", $studentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && $row['Password'] !== NULL) {
        if ($currentPassword === $row['Password']) { // Direct comparison since passwords are not hashed
            $hashedPassword = $newPassword; // No hashing since passwords are stored in plain text
            $sql = "UPDATE tblusers_osa SET Password = ? WHERE UserID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                $_SESSION['error'] = "Database error: Failed to prepare statement.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $studentId);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Password successfully changed.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                $_SESSION['error'] = "Failed to update password.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            $_SESSION['error'] = "Old password is incorrect.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        $_SESSION['error'] = "Old password is NULL.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>
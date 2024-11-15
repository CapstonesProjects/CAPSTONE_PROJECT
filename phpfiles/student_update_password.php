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

    $sql = "SELECT Password FROM tblusers_student WHERE UserID = ?";
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
        if (password_verify($currentPassword, $row['Password'])) { // Verify the hashed password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password
            $sql = "UPDATE tblusers_student SET Password = ? WHERE UserID = ?";
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
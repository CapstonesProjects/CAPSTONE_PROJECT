<?php
session_start();
include('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "New password and confirm password do not match.";
        
        exit;
    }

    $studentId = $_SESSION['logged_in_user_id'];

    $sql = "SELECT password FROM student_info WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $studentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row['password'] !== NULL) {
        if (password_verify($currentPassword, $row['password'])) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE student_info SET password = ? WHERE student_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $studentId);
            mysqli_stmt_execute($stmt);

            $_SESSION['success'] = "Password Successfully Changed.";
        } else {
            $_SESSION['error'] = "Old password is incorrect.";
        }
    } else {
        $_SESSION['error'] = "Old password is NULL.";
    }

  
    exit;
}
?>
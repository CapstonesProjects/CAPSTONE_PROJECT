<?php 
session_start();
include('../config/db_connection.php');

if (!isset($_SESSION['UserID'])) {
    $_SESSION['error'] = "You must be logged in to change your password.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "New password and confirm password do not match.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $studentId = $_SESSION['UserID'];

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE tblusers_student SET Password = ?, password_changed = 1 WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $_SESSION['error'] = "Database error: Failed to prepare statement.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $studentId);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Password successfully changed.";
        unset($_SESSION['password_needs_change']);
        unset($_SESSION['default_password']);
        header('Location: ../Student/Student_Dashboard.php'); // Redirect to the dashboard or another page
        exit;
    } else {
        $_SESSION['error'] = "Failed to update password.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>
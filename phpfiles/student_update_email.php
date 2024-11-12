<?php
session_start();
include('../config/db_connection.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['UserID'])) {
    $_SESSION['error'] = "You must be logged in to change your email.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentEmail = $_POST['current-email'];
    $newEmail = $_POST['new-email'];

    $userId = $_SESSION['UserID'];

    // Check if the current email matches the one in the session
    if ($currentEmail !== $_SESSION['Email']) {
        $_SESSION['error'] = "Current email does not match.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Check if the new email already exists in the database
    $sql = "SELECT * FROM tblusers_student WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $_SESSION['error'] = "Database error: Failed to prepare statement.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "s", $newEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($result)) {
        $_SESSION['error'] = "The new email address is already in use.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Update the email in the database
    $sql = "UPDATE tblusers_student SET Email = ? WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $_SESSION['error'] = "Database error: Failed to prepare statement.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "ss", $newEmail, $userId);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Email successfully changed.";
        $_SESSION['Email'] = $newEmail; // Update the session email
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        $_SESSION['error'] = "Failed to update email.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>
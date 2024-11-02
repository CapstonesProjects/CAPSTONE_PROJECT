<?php
session_start(); // Start the session
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_connection.php');

$response = [];

// var_dump($_POST); // Debugging output to see the received POST data

if (isset($_POST['body']) && isset($_POST['receiverId']) && isset($_POST['receiverType']) && isset($_POST['subject']) && isset($_POST['fullName']) && isset($_POST['fullNameSender'])) {
    $body = $_POST['body'];
    $receiverId = $_POST['receiverId'];
    $receiverType = $_POST['receiverType'];
    $subject = $_POST['subject'];
    $fullNameReceiver = $_POST['fullName'];
    $fullNameSender = $_POST['fullNameSender'];

    // Debugging output to check the received values
    error_log("Received values: body=$body, receiverId=$receiverId, receiverType=$receiverType, subject=$subject, fullNameReceiver=$fullNameReceiver, fullNameSender=$fullNameSender");

    // Assuming the AdminNumber is stored in the session
    if (isset($_SESSION['OSA_number'])) {
        $osaNumber = $_SESSION['OSA_number'];
        error_log("OSA_number is set: " . $osaNumber); // Debugging statement
    } else {
        error_log("OSA_number is not set in session"); // Debugging statement
        $_SESSION['error_message'] = 'OSA number not set in session';
        header('Location: ../OSA/OSA_Send_Message.php');
        exit;
    }

    // Save the message with the correct receiverId, receiverType, subject, body, sender, FullNameReceiver, and FullNameSender
    $query = "INSERT INTO messages (receiver, receiverType, subject, body, status, created_at, sender, FullNameReceiver, FullNameSender) VALUES (?, ?, ?, ?, 'sent', NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $_SESSION['error_message'] = 'Failed to prepare statement';
        header('Location: ../OSA/OSA_Send_Message.php');
        exit;
    }
    $stmt->bind_param("sssssss", $receiverId, $receiverType, $subject, $body, $osaNumber, $fullNameReceiver, $fullNameSender);
    $stmt->execute();

    // Debugging output to check the execution result
    error_log("Execution result: affected_rows=" . $stmt->affected_rows);

    if ($stmt->affected_rows > 0) {
        $_SESSION['success_message'] = 'Message sent successfully';
    } else {
        $_SESSION['error_message'] = 'Failed to send message';
    }
    header('Location: ../OSA/OSA_Send_Message.php');
    exit;
} else {
    $_SESSION['error_message'] = 'Message, receiverId, receiverType, subject, FullNameReceiver, or FullNameSender not set';
    header('Location: ../OSA/OSA_Send_Message.php');
    exit;
}
?>
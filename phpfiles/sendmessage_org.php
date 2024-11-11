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
    if (isset($_SESSION['Org_number'])) {
        $orgNumber = $_SESSION['Org_number'];
        error_log("ORG_number is set: " . $osaNumber); // Debugging statement
    } else {
        error_log("ORG_number is not set in session"); // Debugging statement
        $_SESSION['error_message'] = 'ORG number not set in session';
        header('Location: ../ORGANIZATION/ORG_Send_Message.php');
        exit;
    }

    // Save the message with the correct receiverId, receiverType, subject, body, sender, FullNameReceiver, and FullNameSender
    $query = "INSERT INTO messages (receiver, receiverType, subject, body, status, created_at, sender, FullNameReceiver, FullNameSender) VALUES (?, ?, ?, ?, 'sent', NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $_SESSION['error_message'] = 'Failed to prepare statement';
        header('Location: ../ORGANIZATION/ORG_Send_Message.php');
        exit;
    }
    $stmt->bind_param("sssssss", $receiverId, $receiverType, $subject, $body, $orgNumber, $fullNameReceiver, $fullNameSender);
    $stmt->execute();

    // Debugging output to check the execution result
    error_log("Execution result: affected_rows=" . $stmt->affected_rows);

    if ($stmt->affected_rows > 0) {
        // Get the last inserted message ID
        $message_id = $stmt->insert_id;

        // Handle file uploads if there are any attachments
        if (isset($_FILES["attachments"]) && !empty($_FILES["attachments"]["tmp_name"][0])) {
            $upload_dir = "../uploads-messages/";
            foreach ($_FILES["attachments"]["tmp_name"] as $key => $tmp_name) {
                $file_name = basename($_FILES["attachments"]["name"][$key]);
                $target_file = $upload_dir . $file_name;

                // Debugging output to check file upload details
                error_log("Uploading file: tmp_name=$tmp_name, target_file=$target_file");

                // Move the uploaded file to the target directory
                if (move_uploaded_file($tmp_name, $target_file)) {
                    // Store the relative path without the leading "../"
                    $relative_path = "uploads-messages/" . $file_name;

                    // Insert file path into the message_attachments table
                    $sql = "INSERT INTO message_attachments (MessageID, file_path) VALUES (?, ?)";
                    $stmt_attachment = $conn->prepare($sql);
                    if ($stmt_attachment === false) {
                        error_log("Failed to prepare statement for message_attachments");
                        continue;
                    }
                    $stmt_attachment->bind_param("is", $message_id, $relative_path);
                    if ($stmt_attachment->execute()) {
                        error_log("File path inserted into message_attachments: $relative_path");
                    } else {
                        error_log("Failed to insert file path into message_attachments: " . $stmt_attachment->error);
                    }
                    $stmt_attachment->close();
                } else {
                    error_log("Failed to move uploaded file: $tmp_name to $target_file");
                }
            }
        } else {
            error_log("No attachments found.");
        }

        $_SESSION['success_message'] = 'Message sent successfully';
    } else {
        $_SESSION['error_message'] = 'Failed to send message';
    }
    header('Location: ../ORGANIZATION/ORG_Send_Message.php');
    exit;
} else {
    $_SESSION['error_message'] = 'Message, receiverId, receiverType, subject, FullNameReceiver, or FullNameSender not set';
    header('Location: ../ORGANIZATION/ORG_Send_Message.php');
    exit;
}
?>
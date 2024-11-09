<?php
session_start();
include('../config/db_connection.php');

if (isset($_GET['id'])) {
    $messageId = $_GET['id'];

    $query = "UPDATE messages SET seen = 1 WHERE MessageID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update message status']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No message ID provided']);
}
?>
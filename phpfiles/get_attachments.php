<?php
include('../config/db_connection.php');

if (isset($_GET['message_id'])) {
    $message_id = intval($_GET['message_id']);

    $query = "SELECT file_path FROM message_attachments WHERE MessageID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $message_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $attachments = [];
    while ($row = $result->fetch_assoc()) {
        $attachments[] = $row;
    }

    echo json_encode($attachments);
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>
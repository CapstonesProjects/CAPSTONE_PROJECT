<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('../config/db_connection.php');

$response = [];

$query = "SELECT sender, subject, body, DATE_FORMAT(created_at, '%b %d, %Y %h:%i %p') as time FROM messages WHERE status = 'inbox'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    echo json_encode(['error' => 'No messages found']);
    exit;
}

echo json_encode($response);
?>
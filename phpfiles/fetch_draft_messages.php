<?php
session_start();
include('../config/db_connection.php');

$response = [];

$query = "SELECT recipient as sender, subject, body, DATE_FORMAT(created_at, '%b %d, %Y %h:%i %p') as time FROM messages WHERE status = 'draft'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

echo json_encode($response);
?>
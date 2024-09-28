<?php
ini_set('display_errors', 1);
session_start();
include('../config/db_connection.php');

$response = [];

$query = "
    SELECT 
        CONCAT(sender_user.FirstName, ' ', sender_user.LastName) AS sender, 
        CONCAT(receiver_user.FirstName, ' ', receiver_user.LastName) AS receiver,
        m.subject, 
        m.body, 
        DATE_FORMAT(m.created_at, '%b %d, %Y %h:%i %p') as time 
    FROM 
        messages m
    JOIN 
        tblusers_osa sender_user ON m.sender = sender_user.OSA_number
    JOIN 
        tblusers_student receiver_user ON m.receiver = receiver_user.StudentID
    WHERE 
        m.status = 'sent'
";
$result = $conn->query($query);

if (!$result) {
    error_log('Query failed: ' . $conn->error);
    echo json_encode(['error' => 'Query failed: ' . $conn->error]);
    exit;
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    error_log('No messages found');
    echo json_encode(['error' => 'No messages found', 'query' => $query]);
    exit;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
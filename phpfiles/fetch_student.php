<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_connection.php');

header('Content-Type: application/json'); // Ensure the response is JSON

$response = [];

if (isset($_GET['query'])) {
    $queryParam = $_GET['query'];
    $response['debug'] = "Received query: $queryParam";

    // Query to fetch from both student and admin tables
    $query = "
        SELECT CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email 
        FROM tblusers_student 
        WHERE StudentID = ?
        UNION
        SELECT CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email 
        FROM tblusers_admin 
        WHERE AdminID = ?
    ";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $response['error'] = 'Failed to prepare statement';
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("ss", $queryParam, $queryParam); // Bind the same parameter for both queries
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['FullName'] = $row['FullName'];
        $response['Email'] = $row['Email'];
    } else {
        $response['FullName'] = '';
        $response['Email'] = '';
    }
} else {
    $response['error'] = 'Query parameter not set';
}

echo json_encode($response);
?>
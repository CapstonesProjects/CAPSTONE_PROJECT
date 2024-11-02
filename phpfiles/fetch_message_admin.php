<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_connection.php');

header('Content-Type: application/json'); // Ensure the response is JSON

$response = [];

if (isset($_GET['query'])) {
    $queryParam = $_GET['query'];
    $response['debug'] = "Received query: $queryParam";

    // Query to fetch from the users table
    $query = "
        SELECT StudentID AS ID, CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email, 'student' AS Type 
        FROM tblusers_student 
        WHERE StudentID LIKE ? OR FirstName LIKE ? OR LastName LIKE ?
        UNION
        SELECT AdminNumber AS ID, CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email, 'Admin' AS Type 
        FROM admin 
        WHERE AdminNumber LIKE ? OR FirstName LIKE ? OR LastName LIKE ?
        UNION
        SELECT OSA_number AS ID, CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email, 'OSA' AS Type 
        FROM tblusers_osa 
        WHERE OSA_number LIKE ? OR FirstName LIKE ? OR LastName LIKE ?
        UNION
        SELECT Org_number AS ID, CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email, 'Organization' AS Type 
        FROM tblusers_organization
        WHERE Org_number LIKE ? OR FirstName LIKE ? OR LastName LIKE ?
    ";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $response['error'] = 'Failed to prepare statement';
        echo json_encode($response);
        exit;
    }
    $searchTerm = "%$queryParam%";
    $stmt->bind_param("ssssssssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm); // Bind the same parameter for all queries
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row;
    }

    $response['suggestions'] = $suggestions;
} else {
    $response['error'] = 'Query parameter not set';
}

echo json_encode($response);
?>
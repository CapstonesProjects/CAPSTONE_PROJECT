<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_connection.php');

header('Content-Type: application/json'); // Ensure the response is JSON

$response = [];

if (isset($_GET['StudentID'])) {
    $studentID = $_GET['StudentID'];
    $response['debug'] = "Received StudentID: $studentID";

    // Concatenate FirstName, MiddleName (if exists), and LastName to form FullName
    $query = "SELECT StudentID, CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email FROM tblusers_student WHERE StudentID LIKE ? OR FirstName LIKE ? OR LastName LIKE ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $response['error'] = 'Failed to prepare statement';
        echo json_encode($response);
        exit;
    }
    $searchTerm = "%$studentID%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row;
    }

    $response['suggestions'] = $suggestions;
} else {
    $response['error'] = 'StudentID not set';
}

echo json_encode($response);
?>
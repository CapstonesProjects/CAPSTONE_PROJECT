<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../config/db_connection.php');

header('Content-Type: application/json'); // Ensure the response is JSON

$response = [];

if (isset($_GET['StudentID']) && isset($_GET['OffenseCategory'])) {
    $studentID = $_GET['StudentID'];
    $offenseCategory = $_GET['OffenseCategory'];
    $response['debug'] = "Received StudentID: $studentID, OffenseCategory: $offenseCategory";

    $query = "SELECT COUNT(*) AS offense_count FROM tblcases WHERE StudentID = ? AND OffenseCategory = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $response['error'] = 'Failed to prepare statement';
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("ss", $studentID, $offenseCategory);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['OffenseCount'] = $row['offense_count'];
    } else {
        $response['OffenseCount'] = 0;
    }
} else {
    $response['error'] = 'StudentID or OffenseCategory not set';
}

echo json_encode($response);
?>
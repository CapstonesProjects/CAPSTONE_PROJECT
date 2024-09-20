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
    $query = "SELECT CONCAT(FirstName, ' ', COALESCE(MiddleName, ''), ' ', LastName) AS FullName, Email FROM tblusers_student WHERE StudentID = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        $response['error'] = 'Failed to prepare statement';
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("s", $studentID); // Corrected to "s"
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
    $response['error'] = 'StudentID not set';
}

echo json_encode($response);
?>
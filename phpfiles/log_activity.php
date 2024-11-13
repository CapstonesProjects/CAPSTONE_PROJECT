<?php
session_start();
include('../config/db_connection.php');

// Function to log activity
function log_activity($conn, $userID, $userType, $firstName, $lastName, $action) {
    $sql = "INSERT INTO activity_log (UserID, UserType, FirstName, LastName, Action) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log('Prepare failed: ' . htmlspecialchars($conn->error));
        echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . htmlspecialchars($conn->error)]);
        return;
    }
    $stmt->bind_param("issss", $userID, $userType, $firstName, $lastName, $action);
    if ($stmt->execute() === false) {
        error_log('Execute failed: ' . htmlspecialchars($stmt->error));
        echo json_encode(['success' => false, 'error' => 'Execute failed: ' . htmlspecialchars($stmt->error)]);
        return;
    }
    $stmt->close();
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];

if (!isset($_SESSION['UserID']) || !isset($_SESSION['UserType']) || !isset($_SESSION['FirstName']) || !isset($_SESSION['LastName'])) {
    error_log('Session variables not set');
    echo json_encode(['success' => false, 'error' => 'Session variables not set']);
    return;
}

$userID = $_SESSION['UserID']; // Assuming the user ID is stored in the session
$userType = $_SESSION['UserType']; // Assuming the user type is stored in the session
$firstName = $_SESSION['FirstName']; // Assuming the user's first name is stored in the session
$lastName = $_SESSION['LastName']; // Assuming the user's last name is stored in the session

log_activity($conn, $userID, $userType, $firstName, $lastName, $action);

echo json_encode(['success' => true]);
?>
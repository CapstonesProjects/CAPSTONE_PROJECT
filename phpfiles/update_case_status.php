<?php
// update_case_status.php
include('../config/db_connection.php');
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caseID = $_POST['caseID'];

    // Check if caseID is set and not empty
    if (isset($caseID) && !empty($caseID)) {
        // Update the case status to 'Resolved'
        $query = "UPDATE tblcases SET Status = 'Resolved' WHERE CaseID = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("i", $caseID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Case status updated successfully
            $_SESSION['success_update_case_status'] = 'Case status updated successfully';
            header("Location: ../OSA/OSA_Cases.php?status=success");
        } else {
            // Check if the caseID exists
            $checkQuery = "SELECT * FROM tblcases WHERE CaseID = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("i", $caseID);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // CaseID exists but no rows were affected, meaning the status was already 'Resolved'
                $_SESSION['success_update_case_status'] = 'Case already resolved';
                header("Location: ../OSA/OSA_Cases.php?status=already_resolved");
            } else {
                // CaseID does not exist
                $_SESSION['error_update_case_status'] = 'Case not found';
                header("Location: ../OSA/OSA_Cases.php?status=not_found");
            }
        }

        $stmt->close();
    } else {
        // Invalid caseID
        $_SESSION['error_update_case_status'] = 'Invalid case ID';
        header("Location: ../OSA/OSA_Cases.php?status=invalid_caseid");
    }
} else {
    // Invalid request method
    $_SESSION['error_update_case_status'] = 'Invalid request method';
    header("Location: ../OSA/OSA_Cases.php?status=invalid_request");
}

$conn->close();
?>
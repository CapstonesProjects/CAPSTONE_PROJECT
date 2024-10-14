<?php
session_start();
include('../config/db_connection.php');

// Add necessary columns to the tblcases table if they don't exist
$addColumnsQuery = "
    ALTER TABLE tblcases
    ADD COLUMN IF NOT EXISTS StartDate DATE,
    ADD COLUMN IF NOT EXISTS EndDate DATE,
    ADD COLUMN IF NOT EXISTS StartLetter VARCHAR(255)
";
if (mysqli_query($conn, $addColumnsQuery)) {
    error_log("Columns added to tblcases table successfully.");
} else {
    error_log("Error adding columns to tblcases table: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caseID = $_POST['caseID'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startLetter = NULL;

    // Handle file uploads
    $uploadDir = "../suspensionfiles/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    function uploadFile($fileInputName, &$filePath) {
        global $uploadDir;
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
            $targetFile = $uploadDir . basename($_FILES[$fileInputName]['name']);
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFile)) {
                $filePath = $targetFile;
                error_log("$fileInputName uploaded successfully: $filePath");
            } else {
                error_log("Error: Failed to upload $fileInputName.");
            }
        } else {
            error_log("$fileInputName upload error: " . $_FILES[$fileInputName]['error']);
        }
    }

    uploadFile('startLetter', $startLetter);

    // Log the value of startLetter
    error_log("Final value of startLetter: " . $startLetter);

    // Determine the status
    $status = (!empty($startDate) && !empty($endDate) && !empty($startLetter)) ? 'Suspended' : 'Pending';

    // Update the case in the database
    $updateQuery = "UPDATE tblcases SET StartDate = ?, EndDate = ?, StartLetter = ?, Status = ? WHERE CaseID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssss", $startDate, $endDate, $startLetter, $status, $caseID);

    if ($stmt->execute()) {
        $_SESSION['update_success'] = 'The suspension details were successfully updated.';
        error_log("Suspension details updated successfully.");
    } else {
        $_SESSION['update_error'] = "Error: " . $stmt->error;
        error_log("Database update error: " . $stmt->error);
    }

    header("Location: ../OSA/OSA_Monitoring.php");
    exit();
}

mysqli_close($conn);
?>
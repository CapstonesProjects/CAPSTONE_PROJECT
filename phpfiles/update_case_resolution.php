<?php
session_start();
include('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caseID = $_POST['caseID'];
    $caseResolution = $_POST['caseResolution'];
    $remarks = $_POST['remarks'];
    $resolutionDate = $_POST['resolutionDate'];

    // Handle file uploads
    $resolutionAttachment = NULL;
    $uploadDir = "../fileattachment/";
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

    uploadFile('resolutionAttachment', $resolutionAttachment);

    // Log the value of resolutionAttachment
    error_log("Final value of resolutionAttachment: " . $resolutionAttachment);

    // Set resolutionDate to current date if empty
    if (empty($resolutionDate)) {
        $resolutionDate = date('Y-m-d');
    }

    // Determine the status based on the case resolution
    $status = 'Resolved';
    if (stripos($caseResolution, 'suspension') !== false) {
        $status = 'Suspended';
    } else {
        $status = $caseResolution;
    }

    // Update the case in the database
    $updateQuery = "UPDATE tblcases SET CaseResolution = ?, Remarks = ?, ResolutionAttachment = ?, ResolutionDate = ?, Status = ? WHERE CaseID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssss", $caseResolution, $remarks, $resolutionAttachment, $resolutionDate, $status, $caseID);

    if ($stmt->execute()) {
        $_SESSION['update_success'] = 'The case resolution was successfully updated.';
        error_log("Case resolution updated successfully.");
    } else {
        $_SESSION['update_error'] = "Error: " . $stmt->error;
        error_log("Database update error: " . $stmt->error);
    }

    header('Location: ../OSA/OSA_Cases.php');
    exit;
}
?>
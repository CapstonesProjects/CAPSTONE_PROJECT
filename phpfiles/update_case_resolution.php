<?php
session_start();
include('../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caseID = $_POST['caseID'];
    $resolutionAttachment = $_FILES['resolutionAttachment'];
    $writtenReprimandAttachment = isset($_FILES['writtenReprimandAttachment']) ? $_FILES['writtenReprimandAttachment'] : null;
    $caseResolution = $_POST['caseResolution'];
    $remarks = $_POST['remarks'];

    // Handle file uploads
    $uploadDir = "../fileattachment/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    function uploadFile($fileInputName, &$filePath)
    {
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

    $resolutionAttachmentPath = '';
    uploadFile('resolutionAttachment', $resolutionAttachmentPath);

    $writtenReprimandAttachmentPath = '';
    if ($writtenReprimandAttachment) {
        uploadFile('writtenReprimandAttachment', $writtenReprimandAttachmentPath);
    }

    // Update the case resolution in the database
    $query = "UPDATE tblcases SET ResolutionAttachment = ?, WrittenReprimandAttachment = ?, CaseResolution = ?, Remarks = ? WHERE CaseID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $resolutionAttachmentPath, $writtenReprimandAttachmentPath, $caseResolution, $remarks, $caseID);

    if ($stmt->execute()) {
        $_SESSION['success_update_case_resolution'] = 'Case resolution updated successfully';
        header("Location: ../OSA/OSA_Cases.php?status=success");
    } else {
        $_SESSION['error_update_case_resolution'] = "Error: " . $stmt->error;
        header("Location: ../OSA/OSA_Cases.php?status=error");
    }

    $stmt->close();
} else {
    // Invalid request method
    $_SESSION['error_update_case_resolution'] = 'Invalid request method';
    header("Location: ../OSA/OSA_Cases.php?status=invalid_request");
}

$conn->close();
?>
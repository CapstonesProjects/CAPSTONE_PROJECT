<?php
session_start(); // Start the session
include('../config/db_connection.php');

if (isset($_POST['btnadd_case'])) {
    if (!isset($_POST['StudentID']) || empty($_POST['StudentID'])) {
        // Handle the error, e.g., display an error message and exit
        $_SESSION['addcases_error'] = "Error: StudentID is not set.";
        header('Location: ../OSA/OSA_Cases.php');
        exit;
    }

    $studentID = $_POST['StudentID'];
    $fullName = $_POST['FullName'];
    $email = $_POST['Email'];
    $offense = $_POST['Offense'];
    $offenseCategory = $_POST['OffenseCategory'];
    $complainant = $_POST['Complainant'];
    $status = $_POST['Status'];
    $date = $_POST['Date'];
    $sanction = $_POST['Sanction']; // Get the sanction from the form

    // Debugging: Log the received values
    error_log("Received values: StudentID=$studentID, FullName=$fullName, Email=$email, Offense=$offense, OffenseCategory=$offenseCategory, Complainant=$complainant, Status=$status, Date=$date, Sanction=$sanction");

    // Handle file uploads
    $reportAttachment = '';
    $writtenReprimandAttachment = '';
    $sanctionLetterAttachment = '';

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

    uploadFile('ReportAttachment', $reportAttachment);
    uploadFile('WrittenReprimandAttachment', $writtenReprimandAttachment);
    uploadFile('SanctionLetterAttachment', $sanctionLetterAttachment);

    // Debugging: Log the file paths
    error_log("File paths: ReportAttachment=$reportAttachment, WrittenReprimandAttachment=$writtenReprimandAttachment, SanctionLetterAttachment=$sanctionLetterAttachment");

    // Check if the StudentID exists in tblusers_student
    $checkQuery = "SELECT * FROM tblusers_student WHERE StudentID = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $studentID); // Assuming StudentID is a string
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if ($checkResult->num_rows == 0) {
        // StudentID does not exist
        $_SESSION['addcases_error'] = "Student ID does not exist.";
        header('Location: ../OSA/OSA_Cases.php');
        exit;
    }

    // Debugging: Log the file paths before inserting into the database
    error_log("Inserting into database: ReportAttachment=$reportAttachment, WrittenReprimandAttachment=$writtenReprimandAttachment, SanctionLetterAttachment=$sanctionLetterAttachment");

    $insertQuery = "INSERT INTO tblcases (
        StudentID, FullName, Email, Offense, OffenseCategory, Sanction, Complainant, Status, Date, ReportAttachment, WrittenReprimandAttachment, SanctionLetterAttachment
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssssssssssss", $studentID, $fullName, $email, $offense, $offenseCategory, $sanction, $complainant, $status, $date, $reportAttachment, $writtenReprimandAttachment, $sanctionLetterAttachment);

    // Debugging: Log the query and bound parameters
    error_log("Executing query: $insertQuery with parameters: StudentID=$studentID, FullName=$fullName, Email=$email, Offense=$offense, OffenseCategory=$offenseCategory, Sanction=$sanction, Complainant=$complainant, Status=$status, Date=$date, ReportAttachment=$reportAttachment, WrittenReprimandAttachment=$writtenReprimandAttachment, SanctionLetterAttachment=$sanctionLetterAttachment");

    if ($stmt->execute()) {
        $_SESSION['addcases_success'] = 'The case was successfully added.';
        error_log("Case added successfully.");
    } else {
        $_SESSION['addcases_error'] = "Error: " . $stmt->error;
        // Debugging: Log the error
        error_log("Database insert error: " . $stmt->error);
    }

    header('Location: ../OSA/OSA_Cases.php');
    exit;
}
?>
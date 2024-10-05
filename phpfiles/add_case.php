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
    $fileddate = $_POST['FiledDate'];
    $sanction = $_POST['Sanction'];
    $complainantnumber = $_POST['ComplainantNumber'];
    $affiliation = $_POST['Affiliation'];
    $schoolyear = $_POST['SchoolYear'];
    $filedby = $_POST['FiledBy'];

    // Handle file uploads
    $reportAttachment = '';
    $writtenReprimandAttachment = '';
    $sanctionLetterAttachment = '';

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

    uploadFile('ReportAttachment', $reportAttachment);
    uploadFile('WrittenReprimandAttachment', $writtenReprimandAttachment);
    uploadFile('SanctionLetterAttachment', $sanctionLetterAttachment);

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

    // Check if the case already exists
    $caseID = $_POST['CaseID']; // Assuming CaseID is passed in the POST request

    $caseCheckQuery = "SELECT * FROM tblcases WHERE CaseID = ?";
    $stmt = $conn->prepare($caseCheckQuery);
    $stmt->bind_param("s", $caseID);
    $stmt->execute();
    $caseCheckResult = $stmt->get_result();

    if ($caseCheckResult->num_rows > 0) {
        // Case already exists
        $_SESSION['addcases_error'] = "Error: This case already exists.";
        header('Location: ../OSA/OSA_Cases.php');
        exit;
    }

    $insertQuery = "INSERT INTO tblcases (
        StudentID, FullName, Email, Offense, OffenseCategory, Sanction, Complainant, Status, FiledDate, ReportAttachment, WrittenReprimandAttachment, SanctionLetterAttachment, ComplainantNumber, Affiliation, SchoolYear, FiledBy
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ssssssssssssssss", $studentID, $fullName, $email, $offense, $offenseCategory, $sanction, $complainant, $status, $fileddate, $reportAttachment, $writtenReprimandAttachment, $sanctionLetterAttachment, $complainantnumber, $affiliation, $schoolyear, $filedby);

    if ($stmt->execute()) {
        $_SESSION['addcases_success'] = 'The case was successfully added.';
        error_log("Case added successfully.");
    } else {
        $_SESSION['addcases_error'] = "Error: " . $stmt->error;
        error_log("Database insert error: " . $stmt->error);
    }

    header('Location: ../OSA/OSA_Cases.php');
    exit;
}
?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function () {
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
        });
    });
</script>
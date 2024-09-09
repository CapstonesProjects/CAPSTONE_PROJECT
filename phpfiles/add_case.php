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
    $offenseCategory = $_POST['OffenseCategory'];
    $offenseDescription = $_POST['OffenseDescription'];
    $status = $_POST['Status'];
    $date = $_POST['Date'];

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

    $insertQuery = "INSERT INTO tblcases (
        StudentID, FullName, Email, OffenseCategory, OffenseDescription, Status, Date
    ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssssss", $studentID, $fullName, $email, $offenseCategory, $offenseDescription, $status, $date);

    if ($stmt->execute()) {
        $_SESSION['addcases_success'] = 'The case was successfully added.';
    } else {
        $_SESSION['addcases_error'] = "Error: " . $stmt->error;
    }

    // Redirect back to the cases page
    header('Location: ../OSA/OSA_Cases.php');
    exit();
}

mysqli_close($conn);
?>
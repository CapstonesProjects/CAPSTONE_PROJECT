<?php
session_start(); // Start the session
include('../config/db_connection.php');

if (isset($_POST['btnadd_student'])) {
    if (!isset($_POST['StudentID'])) {
        // Handle the error, e.g., display an error message and exit
        $_SESSION['error'] = "Error: student_no is not set.";
        header('Location: ../OSA/OSA_StudentProfile.php');
        exit;
    }

    $StudentID = $_POST['StudentID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $MiddleName = $_POST['MiddleName'];
    $Suffix = $_POST['Suffix'];
    $Course = $_POST['Course'];
    $YearLevel = $_POST['YearLevel'];
    $StudentType = $_POST['StudentType'];
    $Email = $_POST['Email'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $DateBirth = $_POST['DateBirth'];
    $Address = $_POST['Address'];
    $Gender = $_POST['Gender'];
    $Nationality = $_POST['Nationality'];
    $EmergencyContact = $_POST['EmergencyContact'];
    $MaritalStatus = $_POST['MaritalStatus'];
    $GuardiansName = $_POST['GuardiansName'];
    $GuardiansContact = $_POST['GuardiansContact'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Role = 'student';
    $Status = $_POST['Status'];

    $insertQuery = "INSERT INTO tblusers_student (
        StudentID, FirstName, LastName, MiddleName, Suffix, Course, YearLevel,
        StudentType, Email, PhoneNumber, DateBirth, Address, Gender, Nationality, EmergencyContact, MaritalStatus, GuardiansName, GuardiansContact, Username, Password, 
        Role, Status
    ) VALUES (
        '$StudentID', '$FirstName', '$LastName', '$MiddleName', '$Suffix', '$Course', '$YearLevel',
        '$StudentType', '$Email', '$PhoneNumber', '$DateBirth', '$Address', '$Gender', '$Nationality', '$EmergencyContact', '$MaritalStatus', '$GuardiansName', '$GuardiansContact', '$Username', '$Password', 
        '$Role', '$Status'
    )";

    if (mysqli_query($conn, $insertQuery)) {
        $_SESSION['success'] = 'The student was successfully added.';
    } else {
        $_SESSION['error'] = "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }

    // Redirect back to the profile page
    header('Location: ../OSA/OSA_StudentProfile.php');
    exit();
}

mysqli_close($conn);
?>
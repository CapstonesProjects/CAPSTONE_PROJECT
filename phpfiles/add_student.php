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

     // Check if the StudentID already exists
     $checkQuery = "SELECT * FROM tblusers_student WHERE StudentID = '$StudentID'";
     $checkResult = mysqli_query($conn, $checkQuery);
 
     if (mysqli_num_rows($checkResult) > 0) {
         // StudentID already exists
         $_SESSION['addingstudent_error'] = "Student ID already exists.";
         header('Location: ../OSA/OSA_StudentProfile.php');
         exit;
     }

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
        $_SESSION['addingstudent_success'] = 'The student was successfully added.';
    } else {
        $_SESSION['addingstudent_error'] = "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }

    // Redirect back to the profile page
    header('Location: ../OSA/OSA_StudentProfile.php');
    exit();
}

mysqli_close($conn);
?>
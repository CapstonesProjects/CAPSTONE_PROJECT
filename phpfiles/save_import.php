<?php
session_start();
include('../config/db_connection.php');

if (isset($_SESSION['preview_data'])) {
    $sheetData = $_SESSION['preview_data'];
    unset($_SESSION['preview_data']); // Clear the session data

    // Check if the sheet data is not empty and has at least one row
    if (!empty($sheetData) && isset($sheetData[1])) {
        // Define the expected headers
        $expectedHeaders = [
            'StudentID', 'FirstName', 'LastName', 'MiddleName', 'Suffix', 'Course', 'YearLevel',
            'StudentType', 'Email', 'PhoneNumber', 'DateBirth', 'Address', 'Gender', 'Nationality',
            'EmergencyContact', 'MaritalStatus', 'GuardiansName', 'GuardiansContact', 'Status'
        ];

        // Validate headers
        $headers = array_values($sheetData[1]);
        if ($headers !== $expectedHeaders) {
            $_SESSION['addingstudent_error'] = "The Excel file headers are incorrect.";
            header('Location: ../OSA/OSA_StudentProfile.php');
            exit();
        }

        foreach ($sheetData as $index => $row) {
            if ($index === 1) {
                // Skip the header row
                continue;
            }

            // Check if the row has the expected number of columns
            if (count($row) < 19) {
                $_SESSION['addingstudent_error'] = "Row $index is not well-structured.";
                continue;
            }

            // Check for empty required fields
            if (empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['F']) || empty($row['G']) || empty($row['H']) || empty($row['I']) || empty($row['J']) || empty($row['K']) || empty($row['L']) || empty($row['M']) || empty($row['N']) || empty($row['O']) || empty($row['P']) || empty($row['Q']) || empty($row['R']) || empty($row['S'])) {
                $_SESSION['addingstudent_error'] = "Row $index has empty required fields.";
                continue;
            }

            // Extract data from the row
            $StudentID = $row['A'];
            $FirstName = $row['B'];
            $LastName = $row['C'];
            $MiddleName = $row['D'];
            $Suffix = $row['E'];
            $Course = $row['F'];
            $YearLevel = $row['G'];
            $StudentType = $row['H'];
            $Email = $row['I'];
            $PhoneNumber = $row['J'];
            $DateBirth = $row['K'];
            $Address = $row['L'];
            $Gender = $row['M'];
            $Nationality = $row['N'];
            $EmergencyContact = $row['O'];
            $MaritalStatus = $row['P'];
            $GuardiansName = $row['Q'];
            $GuardiansContact = $row['R'];
            $Status = $row['S'];
            $Username = $StudentID; // Auto-generate username
            $Password = password_hash($DateBirth, PASSWORD_DEFAULT); // Auto-generate password
            $Role = 'student';

            // Check if the StudentID already exists
            $checkQuery = "SELECT * FROM tblusers_student WHERE StudentID = '$StudentID'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                // StudentID already exists
                $_SESSION['addingstudent_error'] = "Student ID $StudentID already exists.";
                continue;
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
                $_SESSION['addingstudent_success'] = 'The students were successfully added.';
            } else {
                $_SESSION['addingstudent_error'] = "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
            }
        }

        // Redirect back to the profile page
        header('Location: ../OSA/OSA_StudentProfile.php');
        exit();
    } else {
        $_SESSION['addingstudent_error'] = "The uploaded Excel file is empty or not properly formatted.";
        header('Location: ../OSA/OSA_StudentProfile.php');
        exit();
    }
}

mysqli_close($conn);
?>
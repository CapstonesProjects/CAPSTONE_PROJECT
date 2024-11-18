<?php
session_start();
include('../config/db_connection.php');
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['importExcel'])) {
        // Handle Excel file upload
        $file = $_FILES['importExcel']['tmp_name'];

        try {
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Define the expected headers
            $expectedHeaders = [
                'StudentID', 'FirstName', 'LastName', 'MiddleName', 'Suffix', 'Course', 'YearLevel',
                'StudentType', 'Email', 'PhoneNumber', 'DateBirth', 'Address', 'Gender', 'Nationality',
                'EmergencyContact', 'MaritalStatus', 'GuardiansName', 'GuardiansContact', 'Status'
            ];

            // Validate headers
            $headers = $rows[0];
            if ($headers !== $expectedHeaders) {
                $_SESSION['addingstudent_error'] = "The Excel file headers are incorrect.";
                header('Location: ../OSA/OSA_StudentProfile.php');
                exit();
            }

            foreach ($rows as $index => $row) {
                if ($index === 0) {
                    // Skip the header row
                    continue;
                }

                // Check if the row has the expected number of columns
                if (count($row) < 19) {
                    $_SESSION['addingstudent_error'] = "Row $index is not well-structured.";
                    continue;
                }

                // Check for empty required fields
                if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[5]) || empty($row[6]) || empty($row[7]) || empty($row[8]) || empty($row[9]) || empty($row[10]) || empty($row[11]) || empty($row[12]) || empty($row[13]) || empty($row[14]) || empty($row[15]) || empty($row[16]) || empty($row[17]) || empty($row[18])) {
                    $_SESSION['addingstudent_error'] = "Row $index has empty required fields.";
                    continue;
                }

                $StudentID = $row[0];
                $FirstName = $row[1];
                $LastName = $row[2];
                $MiddleName = $row[3];
                $Suffix = $row[4];
                $Course = $row[5];
                $YearLevel = $row[6];
                $StudentType = $row[7];
                $Email = $row[8];
                $PhoneNumber = $row[9];
                $DateBirth = $row[10];
                $Address = $row[11];
                $Gender = $row[12];
                $Nationality = $row[13];
                $EmergencyContact = $row[14];
                $MaritalStatus = $row[15];
                $GuardiansName = $row[16];
                $GuardiansContact = $row[17];
                $Username = $StudentID; // Auto-generate username
                $Password = password_hash($DateBirth, PASSWORD_DEFAULT); // Auto-generate password
                $Role = 'student';
                $Status = $row[18];

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
        } catch (Exception $e) {
            $_SESSION['addingstudent_error'] = "Error loading Excel file: " . $e->getMessage();
        }
    } else {
        // Handle manual form submission
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
        $Username = $StudentID; // Auto-generate username
        $Password = password_hash($DateBirth, PASSWORD_DEFAULT); // Auto-generate password
        $Role = 'student';
        $Status = $_POST['Status'];

        // Check if the StudentID already exists
        $checkQuery = "SELECT * FROM tblusers_student WHERE StudentID = '$StudentID'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // StudentID already exists
            $_SESSION['addingstudent_error'] = "Student ID $StudentID already exists.";
            header('Location: ../OSA/OSA_StudentProfile.php');
            exit();
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
    }

    // Redirect back to the profile page
    header('Location: ../OSA/OSA_StudentProfile.php');
    exit();
}

mysqli_close($conn);
?>
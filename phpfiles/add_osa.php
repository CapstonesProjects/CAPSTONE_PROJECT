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
                'OSA_number', 'FirstName', 'LastName', 'MiddleName', 'Suffix', 'Email', 'PhoneNumber', 'DateBirth', 'Gender', 'Nationality', 'MaritalStatus', 'Username', 'Password', 'Role', 'Status'
            ];

            // Validate headers
            $headers = $rows[0];
            if ($headers !== $expectedHeaders) {
                $_SESSION['addingosa_error'] = "The Excel file headers are incorrect.";
                header('Location: ../Admin/Admin_AddOSA.php');
                exit();
            }

            foreach ($rows as $index => $row) {
                if ($index === 0) {
                    // Skip the header row
                    continue;
                }

                // Check if the row has the expected number of columns
                if (count($row) < 15) {
                    $_SESSION['addingosa_error'] = "Row $index is not well-structured.";
                    continue;
                }

                // Check for empty required fields
                if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[5]) || empty($row[6]) || empty($row[7]) || empty($row[8]) || empty($row[9]) || empty($row[10]) || empty($row[11]) || empty($row[12]) || empty($row[13]) || empty($row[14])) {
                    $_SESSION['addingosa_error'] = "Row $index has empty required fields.";
                    continue;
                }

                $OSA_number = $row[0];
                $FirstName = $row[1];
                $LastName = $row[2];
                $MiddleName = $row[3];
                $Suffix = $row[4];
                $Email = $row[5];
                $PhoneNumber = $row[6];
                $DateBirth = $row[7];
                $Gender = $row[8];
                $Nationality = $row[9];
                $MaritalStatus = $row[10];
                $Username = $row[11];
                $Password = password_hash($row[12], PASSWORD_DEFAULT); // Hash the password
                $Role = $row[13];
                $Status = $row[14];

                // Check if the OSA_number already exists
                $checkQuery = "SELECT * FROM tblusers_osa WHERE OSA_number = '$OSA_number'";
                $checkResult = mysqli_query($conn, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
                    // OSA_number already exists
                    $_SESSION['addingosa_error'] = "OSA number $OSA_number already exists.";
                    continue;
                }

                $insertQuery = "INSERT INTO tblusers_osa (
                    OSA_number, FirstName, LastName, MiddleName, Suffix, Email, PhoneNumber, DateBirth, Gender, Nationality, MaritalStatus, Username, Password, Role, Status
                ) VALUES (
                    '$OSA_number', '$FirstName', '$LastName', '$MiddleName', '$Suffix', '$Email', '$PhoneNumber', '$DateBirth', '$Gender', '$Nationality', '$MaritalStatus', '$Username', '$Password', '$Role', '$Status'
                )";

                if (mysqli_query($conn, $insertQuery)) {
                    $_SESSION['addingosa_success'] = 'The OSA users were successfully added.';
                } else {
                    $_SESSION['addingosa_error'] = "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
                }
            }
        } catch (Exception $e) {
            $_SESSION['addingosa_error'] = "Error loading Excel file: " . $e->getMessage();
        }
    } else {
        // Handle manual form submission
        $OSA_number = $_POST['OSA_number'];
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $MiddleName = $_POST['MiddleName'];
        $Suffix = $_POST['Suffix'];
        $Email = $_POST['Email'];
        $PhoneNumber = $_POST['PhoneNumber'];
        $DateBirth = $_POST['DateBirth'];
        $Gender = $_POST['Gender'];
        $Nationality = $_POST['Nationality'];
        $MaritalStatus = $_POST['MaritalStatus'];
        $Username = $_POST['Username'];
        $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash the password
        $Role = $_POST['Role'];
        $Status = $_POST['Status'];

        // Check if the OSA_number already exists
        $checkQuery = "SELECT * FROM tblusers_osa WHERE OSA_number = '$OSA_number'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // OSA_number already exists
            $_SESSION['addingosa_error'] = "OSA number $OSA_number already exists.";
            header('Location: ../Admin/Admin_AddOSA.php');
            exit();
        }

        $insertQuery = "INSERT INTO tblusers_osa (
            OSA_number, FirstName, LastName, MiddleName, Suffix, Email, PhoneNumber, DateBirth, Gender, Nationality, MaritalStatus, Username, Password, Role, Status
        ) VALUES (
            '$OSA_number', '$FirstName', '$LastName', '$MiddleName', '$Suffix', '$Email', '$PhoneNumber', '$DateBirth', '$Gender', '$Nationality', '$MaritalStatus', '$Username', '$Password', '$Role', '$Status'
        )";

        if (mysqli_query($conn, $insertQuery)) {
            $_SESSION['addingosa_success'] = 'The OSA user was successfully added.';
        } else {
            $_SESSION['addingosa_error'] = "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
        }
    }

    // Redirect back to the profile page
    header('Location: ../Admin/Admin_AddOSA.php');
    exit();
}

mysqli_close($conn);
?>
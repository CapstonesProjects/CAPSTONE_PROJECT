<?php
session_start();
include('../config/db_connection.php');

$newSchoolYear = $_POST['new-school-year'];

// Check if the school year already exists
$query_check = "SELECT * FROM school_years WHERE Year = ?";
$stmt_check = $conn->prepare($query_check);
$stmt_check->bind_param("s", $newSchoolYear);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // School year already exists
    $_SESSION['school_year_error'] = 'The school year already exists.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // Set all existing school years to not current
    $query_reset = "UPDATE school_years SET IsCurrent = FALSE";
    $conn->query($query_reset);

    // Insert the new school year and set it as current
    $query_insert = "INSERT INTO school_years (Year, IsCurrent) VALUES (?, TRUE)";
    $stmt_insert = $conn->prepare($query_insert);
    $stmt_insert->bind_param("s", $newSchoolYear);
    $stmt_insert->execute();

    // Increment YearLevel for students
    $query_update_year_level = "
        UPDATE tblusers_student
        SET YearLevel = CASE
            WHEN YearLevel = '1st Year' THEN '2nd Year'
            WHEN YearLevel = '2nd Year' THEN '3rd Year'
            WHEN YearLevel = '3rd Year' THEN '4th Year'
            WHEN YearLevel = '4th Year' THEN 'Graduate'
            ELSE YearLevel
        END
    ";
    $conn->query($query_update_year_level);

    $_SESSION['school_year_success'] = 'The new school year has been added and set as current, and student year levels have been updated.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
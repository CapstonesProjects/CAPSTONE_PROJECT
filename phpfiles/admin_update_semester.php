<?php
session_start();
include('../config/db_connection.php');

$newSemester = $_POST['new-semester'];

$query_current = "SELECT Name FROM semesters WHERE IsCurrent = TRUE LIMIT 1";
$result_current = $conn->query($query_current);
$currentSemester = $result_current->fetch_assoc()['Name'];

// Check if the new semester matches the current semester
if ($newSemester === $currentSemester) {
    // New semester matches the current semester
    $_SESSION['semester_error'] = 'The selected semester is already the current semester.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Check if the semester already exists
$query_check = "SELECT * FROM semesters WHERE Name = ?";
$stmt_check = $conn->prepare($query_check);
$stmt_check->bind_param("s", $newSemester);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows == 0) {
    // Semester does not exist
    $_SESSION['semester_error'] = 'The selected semester does not exist.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // Set all existing semesters to not current
    $query_reset = "UPDATE semesters SET IsCurrent = FALSE";
    $conn->query($query_reset);

    // Set the selected semester as current
    $query_update = "UPDATE semesters SET IsCurrent = TRUE WHERE Name = ?";
    $stmt_update = $conn->prepare($query_update);
    $stmt_update->bind_param("s", $newSemester);
    $stmt_update->execute();

    $_SESSION['semester_success'] = 'The selected semester has been set as current.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
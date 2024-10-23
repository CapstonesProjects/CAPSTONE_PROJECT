<?php
include('../config/db_connection.php');

// Get the school year from the request
$schoolYear = isset($_GET['schoolYear']) ? $_GET['schoolYear'] : '';

// Initialize counts
$firstSemesterCases = 0;
$secondSemesterCases = 0;

if ($schoolYear) {
    // Query to get cases for 1st semester
    $firstSemesterQuery = "SELECT COUNT(*) as first_semester_cases FROM tblcases WHERE SchoolYear = ? AND Semester = '1st Semester'";
    $stmt = $conn->prepare($firstSemesterQuery);
    $stmt->bind_param("s", $schoolYear);
    $stmt->execute();
    $firstSemesterResult = $stmt->get_result();
    if ($firstSemesterResult) {
        $firstSemesterCases = $firstSemesterResult->fetch_assoc()['first_semester_cases'];
    }

    // Query to get cases for 2nd semester
    $secondSemesterQuery = "SELECT COUNT(*) as second_semester_cases FROM tblcases WHERE SchoolYear = ? AND Semester = '2nd Semester'";
    $stmt = $conn->prepare($secondSemesterQuery);
    $stmt->bind_param("s", $schoolYear);
    $stmt->execute();
    $secondSemesterResult = $stmt->get_result();
    if ($secondSemesterResult) {
        $secondSemesterCases = $secondSemesterResult->fetch_assoc()['second_semester_cases'];
    }
}

$data = [
    'first_semester_cases' => $firstSemesterCases,
    'second_semester_cases' => $secondSemesterCases
];

mysqli_close($conn);

echo json_encode($data);
?>
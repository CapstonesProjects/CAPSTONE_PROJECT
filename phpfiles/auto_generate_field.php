<?php
include('../config/db_connection.php');

if (isset($_GET['StudentID'])) {
    $studentID = $_GET['StudentID'];

    $query = "SELECT CONCAT(FirstName, ' ', LastName) AS FullName, Email FROM tblusers_student WHERE StudentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        echo json_encode($student);
    } else {
        echo json_encode(['error' => 'Student not found']);
    }
} else {
    echo json_encode(['error' => 'StudentID not provided']);
}
?>
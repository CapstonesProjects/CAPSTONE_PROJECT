<?php
include('../config/db_connection.php');

$schoolYear = isset($_GET['schoolYear']) ? $_GET['schoolYear'] : '';

$query = "SELECT u.Course, COUNT(*) as cases
          FROM tblusers_student u
          LEFT JOIN tblcases c ON u.StudentID = c.StudentID AND c.SchoolYear = ? AND c.ResolutionDate IS NOT NULL
          GROUP BY u.Course";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(['error' => 'Failed to prepare statement']);
    exit;
}
$stmt->bind_param("s", $schoolYear);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
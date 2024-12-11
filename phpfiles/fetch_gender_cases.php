<?php
include('../config/db_connection.php');

$schoolYear = isset($_GET['schoolYear']) ? $_GET['schoolYear'] : '';

$query = "SELECT u.Gender, COUNT(*) as cases
          FROM tblcases c
          JOIN tblusers_student u ON c.StudentID = u.StudentID
          WHERE c.SchoolYear = ? AND c.ResolutionDate IS NOT NULL
          GROUP BY u.Gender";
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
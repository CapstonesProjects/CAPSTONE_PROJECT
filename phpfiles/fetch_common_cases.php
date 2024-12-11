<?php
include('../config/db_connection.php');

$schoolYear = isset($_GET['schoolYear']) ? $_GET['schoolYear'] : '';

$query = "SELECT c.Offense, COUNT(*) as cases
          FROM tblcases c
          WHERE c.SchoolYear = ? AND c.ResolutionDate IS NOT NULL
          GROUP BY c.Offense
          ORDER BY cases DESC
          LIMIT 10"; // Adjust the limit as needed
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
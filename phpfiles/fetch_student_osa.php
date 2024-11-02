<?php
include('../config/db_connection.php');

$query = $_GET['query'];
$suggestions = [];

// Fetch students
$studentQuery = $conn->prepare("SELECT StudentID AS id, CONCAT(FirstName, ' ', LastName) AS fullName, 'student' AS type FROM tblusers_student WHERE CONCAT(FirstName, ' ', LastName) LIKE ?");
$studentQuery->execute(["%$query%"]);
while ($row = $studentQuery->fetch(PDO::FETCH_ASSOC)) {
    $suggestions[] = $row;
}

// Fetch admins
$adminQuery = $conn->prepare("SELECT AdminNumber AS id, CONCAT(FirstName, ' ', LastName) AS fullName, 'admin' AS type FROM admin WHERE CONCAT(FirstName, ' ', LastName) LIKE ?");
$adminQuery->execute(["%$query%"]);
while ($row = $adminQuery->fetch(PDO::FETCH_ASSOC)) {
    $suggestions[] = $row;
}

echo json_encode(['suggestions' => $suggestions]);
?>
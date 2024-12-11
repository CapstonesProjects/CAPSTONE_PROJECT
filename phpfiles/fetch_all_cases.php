<?php
// fetch_cases_data.php
include('../config/db_connection.php');

$data = [];

// Fetch total cases
$query_total_cases = "SELECT COUNT(*) AS total FROM tblcases WHERE ResolutionDate IS NOT NULL";
$result_total_cases = $conn->query($query_total_cases);
$total_cases = $result_total_cases->fetch_assoc()['total'];

// Fetch resolved cases
$query_resolved_cases = "SELECT COUNT(*) AS resolved FROM tblcases WHERE status LIKE '%Resolved%'";
$result_resolved_cases = $conn->query($query_resolved_cases);
$resolved_cases = $result_resolved_cases->fetch_assoc()['resolved'];


// Fetch ongoing cases
$query_ongoing_cases = "SELECT COUNT(*) AS ongoing FROM tblcases WHERE status = 'ongoing'";
$result_ongoing_cases = $conn->query($query_ongoing_cases);
$ongoing_cases = $result_ongoing_cases->fetch_assoc()['ongoing'];

$data['total'] = $total_cases;
$data['resolved'] = $resolved_cases;
$data['ongoing'] = $ongoing_cases;

mysqli_close($conn);

echo json_encode($data);
?>
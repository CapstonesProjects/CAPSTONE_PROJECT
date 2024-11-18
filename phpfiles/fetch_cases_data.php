<?php
// fetch_cases_data.php
include('../config/db_connection.php');

$schoolYear = isset($_GET['schoolYear']) ? $_GET['schoolYear'] : '';

if ($schoolYear) {
    $query = "SELECT MONTHNAME(ResolutionDate) as month, COUNT(*) as cases 
              FROM tblcases 
              WHERE ResolutionDate IS NOT NULL AND SchoolYear = ? 
              GROUP BY MONTH(ResolutionDate)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $schoolYear);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT MONTHNAME(ResolutionDate) as month, COUNT(*) as cases 
              FROM tblcases 
              WHERE ResolutionDate IS NOT NULL 
              GROUP BY MONTH(ResolutionDate)";
    $result = mysqli_query($conn, $query);
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);


?>
<?php
// fetch_cases_percentage.php
include('../config/db_connection.php');

$query = "SELECT SchoolYear, COUNT(*) as cases 
          FROM tblcases 
          WHERE ResolutionDate IS NOT NULL 
          GROUP BY SchoolYear";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
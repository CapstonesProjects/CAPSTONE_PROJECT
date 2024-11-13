<?php
include('../config/db_connection.php');

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch activity log data from the database
$query = "SELECT LogID, UserID, UserType, FirstName, LastName, Action, Timestamp FROM activity_log ORDER BY Timestamp DESC";
$result = mysqli_query($conn, $query);

// Check if query execution is successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container py-3 px-1 ml-12 overflow-hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-hidden relative" style="height: 860px; width: 1500px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-center bg-gray-200 text-gray-600">
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Log ID</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">User ID</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">User Type</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">First Name</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Last Name</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Action</th>
                        <th class="sticky top-0 border-b border-gray-300 px-6 py-2 font-bold tracking-wider uppercase text-xs text-center">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-100 cursor-pointer">
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['LogID']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['UserID']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['UserType']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['FirstName']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['LastName']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['Action']; ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-300 px-6 py-3 text-center">
                                <span class="text-gray-700 px-4 py-2 flex items-center justify-center"><?php echo $row['Timestamp']; ?></span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
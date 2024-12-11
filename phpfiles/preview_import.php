<?php
session_start();
require '../vendor/autoload.php'; // Ensure this path is correct

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['importExcel']) && $_FILES['importExcel']['error'] == 0) {
    $file = $_FILES['importExcel']['tmp_name'];
    try {
        $spreadsheet = IOFactory::load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // Debugging: Log the sheet data
        // echo '<pre>';
        // print_r($sheetData);
        // echo '</pre>';

        // Check if the sheet data is not empty and has at least one row
        if (!empty($sheetData) && isset($sheetData[1])) {
            // Store the data in session for later use
            $_SESSION['preview_data'] = $sheetData;

            // Display the preview
            echo '<!DOCTYPE html>';
            echo '<html lang="en">';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            echo '<title>Preview Imported Data</title>';
            echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">';
            echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">';
            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">';
            echo '<script src="https://code.jquery.com/jquery-3.5.1.js"></script>';
            echo '<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>';
            echo '<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>';
            echo '</head>';
            echo '<body class="bg-gray-100">';
            echo '<div class="container mx-auto p-4 max-w-12xl h-screen">';
            echo '<h2 class="text-2xl font-bold mb-4">Preview Imported Data</h2>';
            echo '<form action="save_import.php" method="POST">';
            echo '<div class="overflow-x-auto bg-white p-4 rounded-lg shadow-md">';
            echo '<table id="previewTable" class="min-w-full bg-white">';
            echo '<thead class="bg-blue-500 text-white">';
            echo '<tr>';
            foreach ($sheetData[1] as $header) {
                echo '<th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">' . htmlspecialchars($header) . '</th>';
            }
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="bg-white divide-y divide-gray-200">';
            for ($i = 2; $i <= count($sheetData); $i++) {
                echo '<tr class="hover:bg-gray-100">';
                foreach ($sheetData[$i] as $cell) {
                    echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' . htmlspecialchars($cell) . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '<div class="mt-4 flex justify-end">';
            echo '<button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow-md">Confirm Import</button>';
            echo '</div>';
            echo '</form>';
            echo '</div>';
            echo '<script>';
            echo '$(document).ready(function() {';
            echo '$("#previewTable").DataTable();';
            echo '});';
            echo '</script>';
            echo '</body>';
            echo '</html>';
        } else {
            echo '<p class="text-red-500">The uploaded Excel file is empty or not properly formatted.</p>';
        }
    } catch (Exception $e) {
        echo '<p class="text-red-500">Error loading Excel file: ' . $e->getMessage() . '</p>';
    }
} else {
    echo '<p class="text-red-500">Failed to upload the Excel file. Please try again.</p>';
}
?>
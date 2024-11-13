<?php
include('../config/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Charts</title>
</head>

<style>
  .spinner-border {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    vertical-align: text-bottom;
    border: 0.25em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    animation: spinner-border 0.75s linear infinite;
  }

  @keyframes spinner-border {
    100% {
      transform: rotate(360deg);
    }
  }


</style>

<body>
  <?php include('../alerts/download_reports_alerts.php') ?>
  <div class="antialiased sans-serif w-lg">
    <div class="px-2 w-full">
      <div class="py-5">
        <div class="p-4 bg-white overflow-visible" style="height: 840px; width: 100%;">
          <div class="md:flex md:justify-between md:items-center mb-4">
            <!-- Legends -->
            <div class="flex items-center mb-4">
              <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
              <div class="text-sm text-gray-700">Cases</div>
            </div>

            <!-- School Year Dropdown -->
            <div class="mb-4">
              <select id="schoolYear" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Select a school year</option>
                <option value="2021-2022">2021-2022</option>
                <option value="2022-2023">2022-2023</option>
                <option value="2023-2024">2023-2024</option>
                <option value="2024-2025">2024-2025</option>
              </select>
            </div>

            <!-- Download Report Button -->
            <div class="mb-4">
              <a id="downloadReport" href="#" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded inline-flex items-center shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 48 48" class="mr-2">
                  <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path>
                  <path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path>
                  <path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path>
                  <path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                </svg>
                Download Report
              </a>
            </div>

            <!-- Confirmation Modal -->
            <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
              <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                <h2 class="text-xl font-bold mb-4">Confirm Download</h2>
                <p class="mb-4">Are you sure you want to download the report?</p>
                <div class="flex justify-end">
                  <button id="cancelButton" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2">Cancel</button>
                  <button id="confirmButton" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Confirm</button>
                </div>
              </div>
            </div>

          </div>

          <!-- UI for Total Cases by Category -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <div class="bg-blue-200 p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-bold text-blue-800 mb-2">Total Cases</h3>
              <p id="totalCases" class="text-2xl font-semibold text-blue-600">0</p>
            </div>
            <div class="bg-green-200 p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-bold text-green-800 mb-2">Resolved Cases</h3>
              <p id="resolvedCases" class="text-2xl font-semibold text-green-600">0</p>
            </div>
            <div class="bg-yellow-200 p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-bold text-yellow-800 mb-2">Ongoing Cases</h3>
              <p id="ongoingCases" class="text-2xl font-semibold text-yellow-600">0</p>
            </div>
          </div>

          <!-- Grid Container for Charts -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Container for Total Cases Chart -->
            <div class="bg-white shadow-lg rounded-md p-4" style="width: 740px; height: 280px;">
              <h3 class="text-lg font-bold text-gray-800 mb-4">Monthly Total Cases</h3>
              <canvas id="myChart"></canvas>
              <div id="noDataMessage" class="text-center text-gray-500" style="display: none; margin-top: -2.5rem;">No data available.</div>
            </div>

            <!-- Container for Minor and Major Offenses Chart -->
            <div class="bg-white shadow-lg rounded-md p-4" style="width: 740px; height: 280px;">
              <h3 class="text-lg font-bold text-gray-800 mb-4">Minor and Major Offenses</h3>
              <canvas id="offenseChart" style="height: 275px;" width="700" height="275"></canvas>
              <div id="noOffenseDataMessage" class="text-center text-gray-500" style="display: none; margin-top: -10rem;">No data available.</div>
            </div>

            <!-- Container for Percentage of Cases per School Year -->
            <div class="bg-white shadow-lg rounded-md p-4" style="width: 740px; height: 280px;">
              <h3 class="text-lg font-bold text-gray-800 mb-4">Percentage of Cases per School Year</h3>
              <canvas id="percentageChart" style="height: 275px;" width="700" height="275"></canvas>
              <div id="noPercentageDataMessage" class="text-center text-gray-500 mt-4" style="display: none; margin-top: -10rem;">No data available.</div>
            </div>

            <!-- Container for Cases per Semester Chart -->
            <div class="bg-white shadow-lg rounded-md p-4" style="width: 740px; height: 280px;">
              <h3 class="text-lg font-bold text-gray-800 mb-4">Cases per Semester</h3>
              <canvas id="semesterChart" style="height: 285px;" width="700" height="275"></canvas>
              <div id="noSemesterDataMessage" class="text-center text-gray-500" style="display: none; margin-top: -10rem;">No data available.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="error-message-container" style="display: flex; justify-content: center; align-items: flex-start; position: fixed; top: -2%; left: 10%; right: 0; z-index: 1000;"></div>

<script src="../javascript/download_report_alerts_modal.js"></script>
</body>


</html>
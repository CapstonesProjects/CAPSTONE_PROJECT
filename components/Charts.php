<?php
include('../config/db_connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
  <div class="antialiased sans-serif w-lg">
    <div class="px-2 w-full">
      <div class="py-5">
        <div class=" p-4  bg-white overflow-hidden " style="height: 830px; width: 1575px;">
          <div class="md:flex md:justify-between md:items-center">
            <div>
              <!-- <h2 class="text-xl text-gray-800 font-bold leading-tight">Cases</h2> -->
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

            <!-- Legends -->
            <div class="mb-4">
              <div class="flex items-center">
                <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
                <div class="text-sm text-gray-700">Cases</div>
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
</body>

</html>
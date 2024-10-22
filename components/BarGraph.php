<?php
include('../config/db_connection.php');

// Function to get the counts
function getCaseCounts($schoolYear) {
    global $conn;

    // Query to get resolved cases
    $resolvedQuery = "SELECT COUNT(*) as resolved_cases FROM tblcases WHERE SchoolYear = ? AND Status LIKE '%Resolved%'";
    $stmt = $conn->prepare($resolvedQuery);
    $stmt->bind_param("s", $schoolYear);
    $stmt->execute();
    $resolvedResult = $stmt->get_result();
    $resolvedCases = $resolvedResult->fetch_assoc()['resolved_cases'];

    // Debugging: Log the resolved cases count
    error_log("Resolved Cases: " . $resolvedCases);

    // Query to get ongoing cases
    $ongoingQuery = "SELECT COUNT(*) as ongoing_cases FROM tblcases WHERE SchoolYear = ? AND Status NOT LIKE '%Resolved%'";
    $stmt = $conn->prepare($ongoingQuery);
    $stmt->bind_param("s", $schoolYear);
    $stmt->execute();
    $ongoingResult = $stmt->get_result();
    $ongoingCases = $ongoingResult->fetch_assoc()['ongoing_cases'];

    // Debugging: Log the ongoing cases count
    error_log("Ongoing Cases: " . $ongoingCases);

    // Calculate total cases
    $totalCases = $resolvedCases + $ongoingCases;

    // Debugging: Log the total cases count
    error_log("Total Cases: " . $totalCases);

    return [
        'resolved_cases' => $resolvedCases,
        'ongoing_cases' => $ongoingCases,
        'total_cases' => $totalCases
    ];
}

// Get the school year from the request (default to an empty string if not set)
$schoolYear = isset($_GET['schoolYear']) ? $_GET['schoolYear'] : '';

// Debugging: Log the school year
error_log("School Year: " . $schoolYear);

// Get the case counts
$caseCounts = getCaseCounts($schoolYear);

// Debugging: Log the case counts
error_log("Case Counts: " . print_r($caseCounts, true));
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chart.js Example</title>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'IBM Plex Mono', sans-serif;
    }

    [x-cloak] {
      display: none;
    }
  </style>
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

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const schoolYearSelect = document.getElementById('schoolYear');
        const totalCasesElement = document.getElementById('totalCases');
        const resolvedCasesElement = document.getElementById('resolvedCases');
        const ongoingCasesElement = document.getElementById('ongoingCases');
        const ctx = document.getElementById('myChart').getContext('2d');
        const offenseCtx = document.getElementById('offenseChart').getContext('2d');
        const percentageCtx = document.getElementById('percentageChart').getContext('2d');
        const semesterCtx = document.getElementById('semesterChart').getContext('2d');
        const noDataMessage = document.getElementById('noDataMessage');
        const noOffenseDataMessage = document.getElementById('noOffenseDataMessage');
        const noPercentageDataMessage = document.getElementById('noPercentageDataMessage');
        const noSemesterDataMessage = document.getElementById('noSemesterDataMessage');
        let myChart;
        let offenseChart;
        let percentageChart;
        let semesterChart;

        function destroyCharts() {
          if (myChart) {
            myChart.destroy();
          }
          if (offenseChart) {
            offenseChart.destroy();
          }
          if (percentageChart) {
            percentageChart.destroy();
          }
          if (semesterChart) {
            semesterChart.destroy();
          }
        }

        function fetchData(schoolYear) {
          destroyCharts();

          if (!schoolYear) {
            noDataMessage.style.display = 'block';
            noOffenseDataMessage.style.display = 'block';
            noPercentageDataMessage.style.display = 'block';
            noSemesterDataMessage.style.display = 'block';
            return;
          }

          noDataMessage.style.display = 'none';
          noOffenseDataMessage.style.display = 'none';
          noPercentageDataMessage.style.display = 'none';
          noSemesterDataMessage.style.display = 'none';

          fetch(`../phpfiles/fetch_cases_data.php?schoolYear=${schoolYear}`)
            .then(response => response.json())
            .then(data => {
              console.log(data); // Debugging: Log the fetched data
              if (data.length === 0) {
                console.error('No data fetched');
                noDataMessage.style.display = 'block';
                return;
              }

              const labels = data.map(item => item.month);
              const values = data.map(item => parseInt(item.cases)); // Ensure values are integers

              myChart = new Chart(ctx, {
                type: 'bar', // Ensure the chart type is set to 'bar'
                data: {
                  labels: labels,
                  datasets: [{
                    label: 'Cases',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 1)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    barThickness: 30, // Adjust the bar thickness
                    maxBarThickness: 30 // Maximum bar thickness
                  }]
                },
                options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  scales: {
                    y: {
                      beginAtZero: true,
                      ticks: {
                        stepSize: 1, // Ensure the y-axis increments by 1
                        callback: function(value) {
                          if (Number.isInteger(value)) {
                            return value;
                          }
                        }
                      }
                    }
                  },
                  plugins: {
                    legend: {
                      display: true,
                      labels: {
                        color: 'rgb(54, 162, 235)'
                      }
                    },
                    tooltip: {
                      enabled: true,
                      backgroundColor: 'rgba(0,0,0,0.7)',
                      titleColor: '#fff',
                      bodyColor: '#fff',
                      borderColor: 'rgba(54, 162, 235, 1)',
                      borderWidth: 1
                    }
                  }
                }
              });

              console.log('Chart initialized:', myChart); // Debugging: Log the chart initialization
            })
            .catch(error => {
              console.error('Error fetching data:', error);
              noDataMessage.style.display = 'block';
            });

          fetch(`../phpfiles/fetch_offense_category.php?schoolYear=${schoolYear}`)
            .then(response => response.json())
            .then(data => {
              console.log(data); // Debugging: Log the fetched data
              if (data.length === 0) {
                console.error('No data fetched');
                noOffenseDataMessage.style.display = 'block';
                return;
              }

              const labels = data.map(item => item.month);
              const minorValues = data.map(item => parseInt(item.minor_cases)); // Ensure values are integers
              const majorValues = data.map(item => parseInt(item.major_cases)); // Ensure values are integers

              console.log('Labels:', labels); // Debugging: Log the labels
              console.log('Minor Values:', minorValues); // Debugging: Log the minor values
              console.log('Major Values:', majorValues); // Debugging: Log the major values

              offenseChart = new Chart(offenseCtx, {
                type: 'bar', // Ensure the chart type is set to 'bar'
                data: {
                  labels: labels,
                  datasets: [{
                      label: 'Minor Offenses',
                      data: minorValues,
                      backgroundColor: 'rgba(75, 192, 192, 1)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1,
                      barThickness: 30, // Adjust the bar thickness
                      maxBarThickness: 30 // Maximum bar thickness
                    },
                    {
                      label: 'Major Offenses',
                      data: majorValues,
                      backgroundColor: 'rgba(255, 99, 132, 1)',
                      borderColor: 'rgba(255, 99, 132, 1)',
                      borderWidth: 1,
                      barThickness: 30, // Adjust the bar thickness
                      maxBarThickness: 30 // Maximum bar thickness
                    }
                  ]
                },
                options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  scales: {
                    y: {
                      beginAtZero: true,
                      ticks: {
                        stepSize: 1, // Ensure the y-axis increments by 1
                        callback: function(value) {
                          if (Number.isInteger(value)) {
                            return value;
                          }
                        }
                      }
                    }
                  },
                  plugins: {
                    legend: {
                      display: true,
                      labels: {
                        color: 'rgb(54, 162, 235)'
                      }
                    },
                    tooltip: {
                      enabled: true,
                      backgroundColor: 'rgba(0,0,0,0.7)',
                      titleColor: '#fff',
                      bodyColor: '#fff',
                      borderColor: 'rgba(54, 162, 235, 1)',
                      borderWidth: 1
                    }
                  }
                }
              });

              console.log('Offense Chart initialized:', offenseChart); // Debugging: Log the chart initialization
            })
            .catch(error => {
              console.error('Error fetching data:', error);
              noOffenseDataMessage.style.display = 'block';
            });

          fetch(`../phpfiles/fetch_percentage_schoolyear.php?schoolYear=${schoolYear}`)
            .then(response => response.json())
            .then(data => {
              console.log(data); // Debugging: Log the fetched data
              if (data.length === 0) {
                console.error('No data fetched');
                noPercentageDataMessage.style.display = 'block';
                return;
              }

              const totalCases = data.reduce((sum, item) => sum + parseInt(item.cases), 0);
              const labels = data.map(item => item.SchoolYear);
              const values = data.map(item => (parseInt(item.cases) / totalCases * 100).toFixed(2)); // Calculate percentage

              console.log('Labels:', labels); // Debugging: Log the labels
              console.log('Values:', values); // Debugging: Log the values

              percentageChart = new Chart(percentageCtx, {
                type: 'line', // Change the chart type to 'line'
                data: {
                  labels: labels,
                  datasets: [{
                    label: 'Percentage of Cases',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: true, // Fill the area under the line
                    tension: 0.4 // Add some curve to the line
                  }]
                },
                options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  scales: {
                    y: {
                      beginAtZero: true,
                      ticks: {
                        stepSize: 10, // Ensure the y-axis increments by 10
                        callback: function(value) {
                          return value + '%'; // Add percentage symbol to y-axis labels
                        }
                      }
                    }
                  },
                  plugins: {
                    legend: {
                      display: true,
                      labels: {
                        color: 'rgb(54, 162, 235)'
                      }
                    },
                    tooltip: {
                      enabled: true,
                      backgroundColor: 'rgba(0,0,0,0.7)',
                      titleColor: '#fff',
                      bodyColor: '#fff',
                      borderColor: 'rgba(54, 162, 235, 1)',
                      borderWidth: 1,
                      callbacks: {
                        label: function(tooltipItem) {
                          return tooltipItem.raw + '%'; // Add percentage symbol to tooltip
                        }
                      }
                    }
                  }
                }
              });

              console.log('Percentage Chart initialized:', percentageChart); // Debugging: Log the chart initialization
            })
            .catch(error => {
              console.error('Error fetching data:', error);
              noPercentageDataMessage.style.display = 'block';
            });

          fetch(`../phpfiles/fetch_semester_counts.php?schoolYear=${schoolYear}`)
            .then(response => response.json())
            .then(data => {
              console.log(data); // Debugging: Log the fetched data
              if (data.length === 0) {
                console.error('No data fetched');
                noSemesterDataMessage.style.display = 'block';
                return;
              }

              // Update Semester Chart
              semesterChart = new Chart(semesterCtx, {
                type: 'bar',
                data: {
                  labels: ['1st Semester', '2nd Semester'],
                  datasets: [{
                    label: 'Cases',
                    data: [data.first_semester_cases, data.second_semester_cases],
                    backgroundColor: ['rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });
            })
            .catch(error => {
              console.error('Error fetching data:', error);
              noSemesterDataMessage.style.display = 'block';
            });
        }

        // Fetch data for the initial school year
        fetchData(schoolYearSelect.value);

        // Add event listener to fetch data when the school year changes
        schoolYearSelect.addEventListener('change', function() {
          fetchData(this.value);
        });
      });
    </script>
  </div>
</body>

</html>
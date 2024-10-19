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
  <div class="antialiased sans-serif w-lg min-h-screen">
    <div class="card-main-container flex max-w-screen max-h-screen overflow-auto">
      <div class="card-container flex flex-col m-2 flex-grow p-4 bg-green-500 shadow-md rounded-md max-w-screen max-h-screen mt-5">
        <div class="card p-3">
          <div class="card-title text-white font-bold text-xl mb-2">Total Violation Cases</div>
          <div class="card-body text-white font-semibold text-lg">1,000</div>
        </div>
      </div>
      <div class="card-container flex flex-col m-2 flex-grow p-4 bg-blue-400 shadow-md rounded-md max-w-screen max-h-screen mt-5">
        <div class="card p-3">
          <div class="card-title text-white font-bold text-xl mb-2">Resolved Cases</div>
          <div class="card-body text-white font-semibold text-lg">800</div>
        </div>
      </div>
      <div class="card-container flex flex-col m-2 flex-grow p-4 bg-red-400 shadow-md rounded-md max-w-screen max-h-screen mt-5">
        <div class="card p-3">
          <div class="card-title text-white font-bold text-xl mb-2">Pending Cases</div>
          <div class="card-body text-white font-semibold text-lg">200</div>
        </div>
      </div>
    </div>

    <div class="px-4 w-11/12 h-64">
      <div class="py-10">
        <div class="shadow p-6 rounded-lg bg-white">
          <div class="md:flex md:justify-between md:items-center">
            <div>
              <h2 class="text-xl text-gray-800 font-bold leading-tight">Cases</h2>
              <p class="mb-2 text-gray-600 text-sm">Monthly Average</p>
            </div>

            <!-- School Year Dropdown -->
            <div class="mb-4">
              <label for="schoolYear" class="block text-sm font-medium text-gray-700">Select School Year</label>
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

          <!-- Bar Chart -->
          <canvas id="myChart" width="400" height="200"></canvas>
          <div id="noDataMessage" class="text-center text-gray-500 mt-4" style="display: none;">No data available for the selected school year.</div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const schoolYearSelect = document.getElementById('schoolYear');
        const ctx = document.getElementById('myChart').getContext('2d');
        const noDataMessage = document.getElementById('noDataMessage');
        let myChart;

        function fetchData(schoolYear) {
          fetch(`../phpfiles/fetch_cases_data.php?schoolYear=${schoolYear}`)
            .then(response => response.json())
            .then(data => {
              console.log(data); // Debugging: Log the fetched data
              if (data.length === 0) {
                console.error('No data fetched');
                if (myChart) {
                  myChart.destroy();
                }
                noDataMessage.style.display = 'block';
                return;
              }

              noDataMessage.style.display = 'none';

              const labels = data.map(item => item.month);
              const values = data.map(item => parseInt(item.cases)); // Ensure values are integers

              console.log('Labels:', labels); // Debugging: Log the labels
              console.log('Values:', values); // Debugging: Log the values

              if (myChart) {
                myChart.destroy();
              }

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
            .catch(error => console.error('Error fetching data:', error)); // Debugging: Log any errors
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
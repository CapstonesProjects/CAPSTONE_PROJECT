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
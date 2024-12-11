document.addEventListener("DOMContentLoaded", function () {
  const schoolYearSelect = document.getElementById("schoolYear");
  const totalCasesElement = document.getElementById("totalCases");
  const resolvedCasesElement = document.getElementById("resolvedCases");
  const ongoingCasesElement = document.getElementById("ongoingCases");
  const ctx = document.getElementById("myChart").getContext("2d");
  const offenseCtx = document.getElementById("offenseChart").getContext("2d");
  const percentageCtx = document
    .getElementById("percentageChart")
    .getContext("2d");
  const semesterCtx = document.getElementById("semesterChart").getContext("2d");
  const programCtx = document.getElementById("programChart").getContext("2d");
  const genderCtx = document.getElementById("genderChart").getContext("2d");
  const commonCasesCtx = document
    .getElementById("commonCasesChart")
    .getContext("2d");
  const noDataMessage = document.getElementById("noDataMessage");
  const noOffenseDataMessage = document.getElementById("noOffenseDataMessage");
  const noPercentageDataMessage = document.getElementById(
    "noPercentageDataMessage"
  );
  const noSemesterDataMessage = document.getElementById(
    "noSemesterDataMessage"
  );
  const noProgramDataMessage = document.getElementById("noProgramDataMessage");
  const noGenderDataMessage = document.getElementById("noGenderDataMessage");
  const noCommonCasesDataMessage = document.getElementById(
    "noCommonCasesDataMessage"
  );
  let myChart;
  let offenseChart;
  let percentageChart;
  let semesterChart;
  let programChart;
  let genderChart;
  let commonCasesChart;

  // Mapping of course names to their acronyms
  const courseAcronyms = {
    "Bachelor of Science in Computer Science": "BSCS",
    "Bachelor of Science in Information Technology": "BSIT",
    "Bachelor of Science in Engineering": "BSE",
    "Bachelor of Science in Business Administration": "BSBA",
    "Bachelor of Science in Psychology": "BSPSYCH",
    "Bachelor of Science in Education": "BSED",
    "Bachelor of Science in Tourism Management": "BSTM",
  };

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
    if (programChart) {
      programChart.destroy();
    }
    if (genderChart) {
      genderChart.destroy();
    }

    if (commonCasesChart) {
      commonCasesChart.destroy();
    }
  }

  function shortenCaseName(caseName) {
    // Define the parts of the case name to be removed
    const prefixesToRemove = [
      "Noncompliance of Academic Requirements - ",
      "Attitude inside the Classroom - ",
      "Behavior in Campus - ",
      "Violation with Legal Implications - ",
      "Indecency in Campus - ",
      "Misconduct in Lyceum Campus - ",
      "Violation by Representative - ",
    ];

    for (const prefix of prefixesToRemove) {
      if (caseName.startsWith(prefix)) {
        return caseName.replace(prefix, "");
      }
    }

    return caseName;
  }

  function fetchData(schoolYear) {
    destroyCharts();

    if (!schoolYear) {
      noDataMessage.style.display = "block";
      noOffenseDataMessage.style.display = "block";
      noPercentageDataMessage.style.display = "block";
      noSemesterDataMessage.style.display = "block";
      noProgramDataMessage.style.display = "block";
      noGenderDataMessage.style.display = "block";
      noCommonCasesDataMessage.style.display = "block";
      return;
    }

    noDataMessage.style.display = "none";
    noOffenseDataMessage.style.display = "none";
    noPercentageDataMessage.style.display = "none";
    noSemesterDataMessage.style.display = "none";
    noProgramDataMessage.style.display = "none";
    noGenderDataMessage.style.display = "none";
    noCommonCasesDataMessage.style.display = "none";

    fetch(`../phpfiles/fetch_cases_data.php?schoolYear=${schoolYear}`)
      .then((response) => response.json())
      .then((data) => {
        console.log(data); // Debugging: Log the fetched data
        if (data.length === 0) {
          console.error("No data fetched");
          noDataMessage.style.display = "block";
          return;
        }

        const labels = data.map((item) => item.month);
        const values = data.map((item) => parseInt(item.cases)); // Ensure values are integers

        myChart = new Chart(ctx, {
          type: "bar", // Ensure the chart type is set to 'bar'
          data: {
            labels: labels,
            datasets: [
              {
                label: "Cases",
                data: values,
                backgroundColor: "rgba(54, 162, 235, 1)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
                barThickness: 30, // Adjust the bar thickness
                maxBarThickness: 30, // Maximum bar thickness
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 1, // Ensure the y-axis increments by 1
                  callback: function (value) {
                    if (Number.isInteger(value)) {
                      return value;
                    }
                  },
                },
              },
            },
            plugins: {
              legend: {
                display: true,
                labels: {
                  color: "rgb(54, 162, 235)",
                },
              },
              tooltip: {
                enabled: true,
                backgroundColor: "rgba(0,0,0,0.7)",
                titleColor: "#fff",
                bodyColor: "#fff",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
              },
            },
          },
        });

        console.log("Chart initialized:", myChart); // Debugging: Log the chart initialization
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        noDataMessage.style.display = "block";
      });

    fetch(`../phpfiles/fetch_offense_category.php?schoolYear=${schoolYear}`)
      .then((response) => response.json())
      .then((data) => {
        console.log(data); // Debugging: Log the fetched data
        if (data.length === 0) {
          console.error("No data fetched");
          noOffenseDataMessage.style.display = "block";
          return;
        }

        const labels = data.map((item) => item.month);
        const minorValues = data.map((item) => parseInt(item.minor_cases)); // Ensure values are integers
        const majorValues = data.map((item) => parseInt(item.major_cases)); // Ensure values are integers

        console.log("Labels:", labels); // Debugging: Log the labels
        console.log("Minor Values:", minorValues); // Debugging: Log the minor values
        console.log("Major Values:", majorValues); // Debugging: Log the major values

        offenseChart = new Chart(offenseCtx, {
          type: "bar", // Ensure the chart type is set to 'bar'
          data: {
            labels: labels,
            datasets: [
              {
                label: "Minor Offenses",
                data: minorValues,
                backgroundColor: "rgba(75, 192, 192, 1)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1,
                barThickness: 30, // Adjust the bar thickness
                maxBarThickness: 30, // Maximum bar thickness
              },
              {
                label: "Major Offenses",
                data: majorValues,
                backgroundColor: "rgba(255, 99, 132, 1)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1,
                barThickness: 30, // Adjust the bar thickness
                maxBarThickness: 30, // Maximum bar thickness
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 1, // Ensure the y-axis increments by 1
                  callback: function (value) {
                    if (Number.isInteger(value)) {
                      return value;
                    }
                  },
                },
              },
            },
            plugins: {
              legend: {
                display: true,
                labels: {
                  color: "rgb(54, 162, 235)",
                },
              },
              tooltip: {
                enabled: true,
                backgroundColor: "rgba(0,0,0,0.7)",
                titleColor: "#fff",
                bodyColor: "#fff",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
              },
            },
          },
        });

        console.log("Offense Chart initialized:", offenseChart); // Debugging: Log the chart initialization
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        noOffenseDataMessage.style.display = "block";
      });

    fetch(
      `../phpfiles/fetch_percentage_schoolyear.php?schoolYear=${schoolYear}`
    )
      .then((response) => response.json())
      .then((data) => {
        console.log(data); // Debugging: Log the fetched data
        if (data.length === 0) {
          console.error("No data fetched");
          noPercentageDataMessage.style.display = "block";
          return;
        }

        const totalCases = data.reduce(
          (sum, item) => sum + parseInt(item.cases),
          0
        );
        const labels = data.map((item) => item.SchoolYear);
        const values = data.map((item) =>
          ((parseInt(item.cases) / totalCases) * 100).toFixed(2)
        ); // Calculate percentage

        console.log("Labels:", labels); // Debugging: Log the labels
        console.log("Values:", values); // Debugging: Log the values

        percentageChart = new Chart(percentageCtx, {
          type: "line", // Change the chart type to 'line'
          data: {
            labels: labels,
            datasets: [
              {
                label: "Percentage of Cases",
                data: values,
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
                fill: true, // Fill the area under the line
                tension: 0.4, // Add some curve to the line
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 10, // Ensure the y-axis increments by 10
                  callback: function (value) {
                    return value + "%"; // Add percentage symbol to y-axis labels
                  },
                },
              },
            },
            plugins: {
              legend: {
                display: true,
                labels: {
                  color: "rgb(54, 162, 235)",
                },
              },
              tooltip: {
                enabled: true,
                backgroundColor: "rgba(0,0,0,0.7)",
                titleColor: "#fff",
                bodyColor: "#fff",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
                callbacks: {
                  label: function (tooltipItem) {
                    return tooltipItem.raw + "%"; // Add percentage symbol to tooltip
                  },
                },
              },
            },
          },
        });

        console.log("Percentage Chart initialized:", percentageChart); // Debugging: Log the chart initialization
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        noPercentageDataMessage.style.display = "block";
      });

    fetch(`../phpfiles/fetch_semester_counts.php?schoolYear=${schoolYear}`)
      .then((response) => response.json())
      .then((data) => {
        console.log(data); // Debugging: Log the fetched data
        if (data.length === 0) {
          console.error("No data fetched");
          noSemesterDataMessage.style.display = "block";
          return;
        }

        // Update Semester Chart
        semesterChart = new Chart(semesterCtx, {
          type: "bar",
          data: {
            labels: ["1st Semester", "2nd Semester"],
            datasets: [
              {
                label: "Cases",
                data: [data.first_semester_cases, data.second_semester_cases],
                backgroundColor: [
                  "rgba(153, 102, 255, 0.2)",
                  "rgba(255, 159, 64, 0.2)",
                ],
                borderColor: [
                  "rgba(153, 102, 255, 1)",
                  "rgba(255, 159, 64, 1)",
                ],
                borderWidth: 1,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        noSemesterDataMessage.style.display = "block";
      });

    fetch(`../phpfiles/fetch_program_cases.php?schoolYear=${schoolYear}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data.error) {
          console.error("Error fetching data:", data.error);
          noProgramDataMessage.style.display = "block";
          return;
        }

        console.log(data); // Debugging: Log the fetched data
        if (data.length === 0) {
          console.error("No data fetched");
          noProgramDataMessage.style.display = "block";
          return;
        }

        const courses = data.map(
          (item) => courseAcronyms[item.Course] || item.Course
        ); // Replace course names with acronyms
        const cases = data.map((item) => item.cases);

        console.log("Courses:", courses); // Debugging: Log the courses
        console.log("Cases:", cases); // Debugging: Log the cases

        programChart = new Chart(programCtx, {
          type: "bar", // Ensure the chart type is set to 'bar'
          data: {
            labels: courses,
            datasets: [
              {
                label: "Cases",
                data: cases,
                backgroundColor: "rgba(75, 192, 192, 1)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1,
                barThickness: 30, // Adjust the bar thickness
                maxBarThickness: 30, // Maximum bar thickness
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 1, // Ensure the y-axis increments by 1
                  callback: function (value) {
                    if (Number.isInteger(value)) {
                      return value;
                    }
                  },
                },
              },
            },
            plugins: {
              legend: {
                display: true,
                labels: {
                  color: "rgb(54, 162, 235)",
                },
              },
              tooltip: {
                enabled: true,
                backgroundColor: "rgba(0,0,0,0.7)",
                titleColor: "#fff",
                bodyColor: "#fff",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
              },
            },
          },
        });

        console.log("Program Chart initialized:", programChart); // Debugging: Log the chart initialization
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        noProgramDataMessage.style.display = "block";
      });

    fetch(`../phpfiles/fetch_gender_cases.php?schoolYear=${schoolYear}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data.error) {
          console.error("Error fetching data:", data.error);
          noGenderDataMessage.style.display = "block";
          return;
        }

        console.log(data); // Debugging: Log the fetched data
        if (data.length === 0) {
          console.error("No data fetched");
          noGenderDataMessage.style.display = "block";
          return;
        }

        const genders = data.map((item) => item.Gender);
        const cases = data.map((item) => item.cases);
        const totalCases = cases.reduce((sum, value) => sum + value, 0);
        const percentages = cases.map((value) =>
          ((value / totalCases) * 100).toFixed(2)
        );

        console.log("Genders:", genders); // Debugging: Log the genders
        console.log("Cases:", cases); // Debugging: Log the cases
        console.log("Percentages:", percentages); // Debugging: Log the percentages

        genderChart = new Chart(genderCtx, {
          type: "pie", // Change the chart type to 'pie'
          data: {
            labels: genders,
            datasets: [
              {
                label: "Cases",
                data: percentages,
                backgroundColor: [
                  "rgba(153, 102, 255, 1)", // Purple
                  "rgba(255, 159, 64, 1)", // Orange
                  "rgba(54, 162, 235, 1)", // Blue
                  "rgba(75, 192, 192, 1)", // Teal
                  "rgba(255, 99, 132, 1)", // Red
                  "rgba(255, 205, 86, 1)", // Yellow
                ],
                borderColor: [
                  "rgba(153, 102, 255, 1)", // Purple
                  "rgba(255, 159, 64, 1)", // Orange
                  "rgba(54, 162, 235, 1)", // Blue
                  "rgba(75, 192, 192, 1)", // Teal
                  "rgba(255, 99, 132, 1)", // Red
                  "rgba(255, 205, 86, 1)", // Yellow
                ],
                borderWidth: 1,
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
              legend: {
                display: true,
                labels: {
                  color: "rgb(54, 162, 235)",
                },
              },
              tooltip: {
                enabled: true,
                backgroundColor: "rgba(0,0,0,0.7)",
                titleColor: "#fff",
                bodyColor: "#fff",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1,
                callbacks: {
                  label: function (tooltipItem) {
                    return tooltipItem.label + ": " + tooltipItem.raw + "%"; // Add percentage symbol to tooltip
                  },
                },
              },
            },
          },
        });

        console.log("Gender Chart initialized:", genderChart); // Debugging: Log the chart initialization
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        noGenderDataMessage.style.display = "block";
      });

      fetch(`../phpfiles/fetch_common_cases.php?schoolYear=${schoolYear}`)
      .then(response => {
          if (!response.ok) {
              throw new Error('Network response was not ok');
          }
          return response.json();
      })
      .then(data => {
          if (data.error) {
              console.error('Error fetching data:', data.error);
              noCommonCasesDataMessage.style.display = 'block';
              return;
          }
  
          console.log(data); // Debugging: Log the fetched data
          if (data.length === 0) {
              console.error('No data fetched');
              noCommonCasesDataMessage.style.display = 'block';
              return;
          }
  
          const offenses = data.map(item => shortenCaseName(item.Offense));
          const fullOffenses = data.map(item => item.Offense);
          const cases = data.map(item => item.cases);
          const totalCases = cases.reduce((sum, value) => sum + value, 0);
          const percentages = cases.map(value => ((value / totalCases) * 100).toFixed(2));
  
          console.log('Offenses:', offenses); // Debugging: Log the offenses
          console.log('Cases:', cases); // Debugging: Log the cases
          console.log('Percentages:', percentages); // Debugging: Log the percentages
  
          // Initialize the pie chart
          commonCasesChart = new Chart(commonCasesCtx, {
              type: 'pie',
              data: {
                  labels: offenses,
                  datasets: [{
                      label: 'Cases',
                      data: percentages,
                      backgroundColor: [
                          'rgba(153, 102, 255, 1)', // Purple
                          'rgba(255, 159, 64, 1)', // Orange
                          'rgba(54, 162, 235, 1)', // Blue
                          'rgba(75, 192, 192, 1)', // Teal
                          'rgba(255, 99, 132, 1)', // Red
                          'rgba(255, 205, 86, 1)' // Yellow
                      ],
                      borderColor: [
                          'rgba(153, 102, 255, 1)', // Purple
                          'rgba(255, 159, 64, 1)', // Orange
                          'rgba(54, 162, 235, 1)', // Blue
                          'rgba(75, 192, 192, 1)', // Teal
                          'rgba(255, 99, 132, 1)', // Red
                          'rgba(255, 205, 86, 1)' // Yellow
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  plugins: {
                      legend: {
                          display: false // Hide the legend
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
                                  return tooltipItem.label + ': ' + tooltipItem.raw + '%'; // Add percentage symbol to tooltip
                              }
                          }
                      }
                  }
              }
          });
  
          // Update the list of cases with percentages
          const casePercentagesList = document.getElementById('casePercentagesList');
          casePercentagesList.innerHTML = '';
          fullOffenses.forEach((offense, index) => {
              const listItem = document.createElement('li');
              listItem.innerHTML = `<span class="font-semibold">${offense}</span>: <span class="text-blue-600 font-bold">${percentages[index]}%</span>`;
              casePercentagesList.appendChild(listItem);
          });
  
          console.log('Common Cases Chart initialized:', commonCasesChart); // Debugging: Log the chart initialization
      })
      .catch(error => {
          console.error('Error fetching data:', error);
          noCommonCasesDataMessage.style.display = 'block';
      });
  }

  // Fetch data for the initial school year
  fetchData(schoolYearSelect.value);

  // Add event listener to fetch data when the school year changes
  schoolYearSelect.addEventListener("change", function () {
    fetchData(this.value);
  });
});

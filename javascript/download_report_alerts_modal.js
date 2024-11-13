document.getElementById('downloadReport').addEventListener('click', function(event) {
  event.preventDefault();
  var schoolYear = document.getElementById('schoolYear').value;
  if (schoolYear === "") {
      var errorMessageContainer = document.getElementById('error-message-container');
      errorMessageContainer.innerHTML = `
      <div id='error-message' class='alert alert-danger flex align-items-center' role='alert' style='margin-top: 20px; width: 260px; padding: 10px; color: black; background-color: #FF6868; border: 1px solid #DCFFB7; border-radius: 4px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-size: 16px;'>
          <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Error:' style='width: 24px; height: 24px;'><use xlink:href='#exclamation-triangle-fill'/></svg>
          <div>
              Please select a school year.
          </div>
          <div class='spinner-border text-danger ms-auto' role='status' style='width: 1rem; height: 1rem;'>
              <span class='visually-hidden'></span>
          </div>
      </div>`;
      setTimeout(function() {
          errorMessageContainer.innerHTML = '';
      }, 3000);
      return false;
  } else {
      document.getElementById('confirmationModal').classList.remove('hidden');
  }
});

document.getElementById('cancelButton').addEventListener('click', function() {
  document.getElementById('confirmationModal').classList.add('hidden');
});

// Ensure the event listener is attached only once
if (!document.getElementById('confirmButton').dataset.listenerAttached) {
  document.getElementById('confirmButton').addEventListener('click', function() {
      console.log('Confirm button clicked'); // Debugging: Log when the confirm button is clicked
      document.getElementById('confirmationModal').classList.add('hidden');
      var schoolYear = document.getElementById('schoolYear').value;

      // Log the activity
      fetch('../phpfiles/log_activity.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({
              action: 'Downloaded report for school year ' + schoolYear
          })
      }).then(response => response.json()).then(data => {
          if (data.success) {
              console.log('Activity logged successfully'); // Debugging: Log when the activity is logged successfully
              // Redirect to generate report
              window.location.href = '../phpfiles/generate_report.php?schoolYear=' + schoolYear;
          } else {
              alert('Failed to log activity: ' + data.error);
          }
      }).catch(error => {
          alert('Failed to log activity: ' + error.message);
      });
  }, { once: true }); // Ensure the event listener is attached only once

  // Mark the listener as attached
  document.getElementById('confirmButton').dataset.listenerAttached = true;
}
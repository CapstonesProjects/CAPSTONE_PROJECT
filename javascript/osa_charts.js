document.addEventListener('DOMContentLoaded', function() {
    fetch('../phpfiles/fetch_all_cases.php')
        .then(response => response.json())
        .then(data => {

            console.log('Fetched data:', data);
            document.getElementById('totalCases').textContent = data.total;
            document.getElementById('resolvedCases').textContent = data.resolved;
            document.getElementById('ongoingCases').textContent = data.ongoing;
        })
        .catch(error => {
            console.error('Error fetching cases data:', error);
        });
});
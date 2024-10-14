document.getElementById('studentId').addEventListener('input', function() {
    const studentID = this.value;

    if (studentID.length > 0) {
        fetch(`../phpfiles/fetch_student.php?StudentID=${studentID}`)
            .then(response => response.text()) // Get raw response as text
            .then(text => {
                // console.log('Raw response:', text); // Log raw response
                return JSON.parse(text); // Parse the response as JSON
            })
            .then(data => {
                // console.log(data); // Debugging: Log the response data
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    document.getElementById('fullName').value = data.FullName;
                    document.getElementById('email').value = data.Email;
                }
            })
            .catch(error => console.error('Error fetching student data:', error));
    } else {
        document.getElementById('fullName').value = '';
        document.getElementById('email').value = '';
    }
});
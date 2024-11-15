document.addEventListener('DOMContentLoaded', function() {
    console.log('auto generate field js loaded');

    const studentIdInput = document.getElementById('studentId');
    if (studentIdInput) {
        studentIdInput.addEventListener('input', function() {
            const studentID = this.value;
            console.log('Student ID:', studentID); // Log the Student ID

            if (studentID.length > 0) {
                fetch(`../phpfiles/auto_generate_field.php?StudentID=${studentID}`)
                    .then(response => response.text()) // Get raw response as text
                    .then(text => {
                        console.log('Raw response:', text); // Log raw response
                        return JSON.parse(text); // Parse the response as JSON
                    })
                    .then(data => {
                        console.log(data); // Debugging: Log the response data
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
    } else {
        console.error('Student ID input field not found');
    }
});
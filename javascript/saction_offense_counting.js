document.getElementById('offense').addEventListener('change', function() {
    const studentID = document.getElementById('studentId').value;
    const offenseCategory = document.getElementById('offenseCategory').value;

    if (studentID.length > 0 && offenseCategory.length > 0) {
        fetch(`../phpfiles/fetch_offense_count.php?StudentID=${studentID}&OffenseCategory=${offenseCategory}`)
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
                    document.getElementById('offenseCount').innerText = `History offenses of student: ${data.OffenseCount}`;

                    // Determine the sanction based on the offense category and count
                    let sanction = '';
                    if (offenseCategory === 'Minor') {
                        switch (data.OffenseCount) {
                            case 0:
                                sanction = 'First offense - Verbal reprimand or censure';
                                break;
                            case 1:
                                sanction = 'Second offense - Written reprimand';
                                break;
                            case 2:
                                sanction = 'Third offense - Parent/Guardian conference';
                                break;
                            case 3:
                                sanction = 'Fourth offense - Suspension for a prescribed period';
                                break;
                            default:
                                sanction = 'Fifth offense - Qualifies for a major offense (Student will undergo due process)';
                                break;
                        }
                    } else if (offenseCategory === 'Major') {
                        switch (data.OffenseCount) {
                            case 0:
                                sanction = 'First offense - Suspension for a period of not less than five (5) days.';
                                break;
                            case 1:
                                sanction = 'Second offense - Suspension for a period of one (1) - two (2) weeks.';
                                break;
                            case 2:
                                sanction = 'Third offense Suspension for one (1) semester.';
                                break;
                            default:
                                sanction = 'Fourth offense - Exclusion or immediate dismissal and non-admission in Lyceum of Alabang (LOA).';
                                break;
                        }
                    }
                    document.getElementById('sanction').innerText = `Sanction: ${sanction}`;
                    document.getElementById('sanctionInput').value = sanction;

                    // Show or hide the Written Reprimand Attachment field
                    const writtenReprimandAttachmentContainer = document.getElementById('writtenReprimandAttachmentContainer');
                    if (sanction === 'Second offense - Written reprimand') {
                        writtenReprimandAttachmentContainer.style.display = 'block';
                    } else {
                        writtenReprimandAttachmentContainer.style.display = 'none';
                    }
                }
            })
            .catch(error => console.error('Error fetching offense count:', error));
    } else {
        document.getElementById('offenseCount').innerText = '';
        document.getElementById('sanction').innerText = '';
        document.getElementById('sanctionInput').value = ''; // Clear the hidden input field

        // Hide the Written Reprimand Attachment field
        document.getElementById('writtenReprimandAttachmentContainer').style.display = 'none';
        // document.getElementById('sanctionLetterAttachmentContainer').style.display = 'none';
    }
});
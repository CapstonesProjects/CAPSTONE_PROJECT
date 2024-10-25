$(document).ready(function() {
    console.log('sessionmessage.js loaded'); // Debugging output

    $('#to').on('input', function() {
        var query = $(this).val();
        console.log('Input event triggered, query:', query); // Debugging output
        if (query.length > 2) {
            console.log('Sending AJAX request with query:', query); // Debugging output
            $.ajax({
                url: '../phpfiles/fetch_student2.php',
                method: 'GET',
                data: { StudentID: query },
                success: function(data) {
                    console.log('AJAX success, data received:', data); // Debugging output
                    if (data.suggestions && data.suggestions.length > 0) {
                        var suggestionsHtml = '';
                        data.suggestions.forEach(function(suggestion) {
                            console.log('Suggestion:', suggestion); // Debugging output
                            suggestionsHtml += '<div class="suggestion-item p-2 cursor-pointer hover:bg-gray-200" data-student-id="' + suggestion.StudentID + '" data-full-name="' + suggestion.FullName + '">' + suggestion.FullName + ' (' + suggestion.StudentID + ')</div>';
                        });
                        $('#suggestions').html(suggestionsHtml).show();
                        console.log('Suggestions displayed'); // Debugging output
                    } else {
                        $('#suggestions').hide();
                        console.log('No suggestions found'); // Debugging output
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error); // Debugging output
                }
            });
        } else {
            $('#suggestions').hide();
            console.log('Query too short, suggestions hidden'); // Debugging output
        }
    });

    $(document).on('click', '.suggestion-item', function() {
    var fullName = $(this).data('full-name');
    var studentID = $(this).data('student-id');
    console.log('Suggestion clicked:', fullName, 'StudentID:', studentID);
    $('#to').val(fullName);
    $('#studentId').val(studentID);
    $('#fullName').val(fullName);
    $('#suggestions').hide();
    console.log('Hidden input fields set:', $('#studentId').val(), $('#fullName').val());
});

    // Add a submit event listener to the form to ensure the studentId is set
    $('form').on('submit', function(event) {
        var studentID = $('#studentId').val();
        if (!studentID || studentID === 'undefined') {
            event.preventDefault(); // Prevent form submission
            alert('Please select a valid student from the suggestions.');
            console.log('Form submission prevented, studentId is invalid:', studentID); // Debugging output
        } else {
            console.log('Form submitted with studentId:', studentID); // Debugging output
        }
    });
});
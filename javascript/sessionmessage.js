console.log('sessionmessage.js loaded');

window.addEventListener('load', function() {
    console.log('script loaded');
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000); // Hide the alert after 3 seconds
    });
});


$(document).ready(function() {
    console.log('sessionmessage.js loaded'); // Debugging output

    $('#to').on('input', function() {
        var query = $(this).val();
        console.log('Input event triggered, query:', query); // Debugging output
        if (query.length > 2) {
            console.log('Sending AJAX request with query:', query); // Debugging output
            $.ajax({
                url: '../phpfiles/fetch_student.php',
                method: 'GET',
                data: { StudentID: query },
                success: function(data) {
                    console.log('AJAX success, data received:', data); // Debugging output
                    if (data.suggestions && data.suggestions.length > 0) {
                        var suggestionsHtml = '';
                        data.suggestions.forEach(function(suggestion) {
                            suggestionsHtml += '<div class="suggestion-item p-2 cursor-pointer hover:bg-gray-200">' + suggestion.FullName + ' (' + suggestion.Email + ')</div>';
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
        var value = $(this).text();
        $('#to').val(value);
        $('#suggestions').hide();
        console.log('Suggestion selected:', value); // Debugging output
    });
});
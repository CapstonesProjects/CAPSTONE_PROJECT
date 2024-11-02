console.log('sessionmessage.js loaded');

window.addEventListener('load', function() {
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000); // Hide the alert after 3 seconds
    });

    $('#to').on('input', function() {
        var query = $(this).val();

        if (query.length > 2) {
            $.ajax({
                url: '../phpfiles/fetch_student.php',
                method: 'GET',
                data: { StudentID: query },
                success: function(data) {
                    if (data.suggestions && data.suggestions.length > 0) {
                        var suggestionsHtml = '';
                        data.suggestions.forEach(function(suggestion) {
                            suggestionsHtml += '<div class="suggestion-item p-2 cursor-pointer hover:bg-gray-200">' + suggestion.FullName + ' (' + suggestion.Email + ')</div>';
                        });
                        $('#suggestions').html(suggestionsHtml).show();
                    } else {
                        $('#suggestions').hide();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                }
            });
        } else {
            $('#suggestions').hide();
        }
    });

    $(document).on('click', '.suggestion-item', function() {
        var value = $(this).text();
        $('#to').val(value);
        $('#suggestions').hide();
    });
});
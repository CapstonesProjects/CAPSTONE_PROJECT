$(document).ready(function() {
    console.log('osa_message_sudg.js loaded'); // Debugging output

    $('#to').on('input', function() {
        var query = $(this).val();
        console.log('Input event triggered, query:', query); // Debugging output
        if (query.length > 2) {
            console.log('Sending AJAX request with query:', query); // Debugging output
            $.ajax({
                url: '../phpfiles/fetch_message_osa.php',
                method: 'GET',
                data: { query: query }, // Use a generic query parameter
                dataType: 'json', // Ensure the response is parsed as JSON
                success: function(data) {
                    console.log('AJAX success, data received:', data); // Debugging output
                    if (data.suggestions && data.suggestions.length > 0) {
                        var suggestionsHtml = '';
                        data.suggestions.forEach(function(suggestion) {
                            console.log('Suggestion:', suggestion); // Debugging output
                            suggestionsHtml += '<div class="suggestion-item p-2 cursor-pointer hover:bg-gray-200" data-receiver-id="' + suggestion.ID + '" data-receiver-type="' + suggestion.Type + '" data-full-name="' + suggestion.FullName + '">' + suggestion.FullName + ' (' + suggestion.ID + ')</div>';
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
                    console.error('Response text:', xhr.responseText); // Debugging output
                }
            });
        } else {
            $('#suggestions').hide();
            console.log('Query too short, suggestions hidden'); // Debugging output
        }
    });

    $(document).on('click', '.suggestion-item', function() {
        var fullName = $(this).data('full-name');
        var receiverID = $(this).data('receiver-id'); // Corrected to lowercase "id"
        var receiverType = $(this).data('receiver-type'); // Added receiver type
        console.log('Suggestion clicked:', fullName, 'ReceiverID:', receiverID, 'ReceiverType:', receiverType);
        $('#to').val(fullName);
        $('#receiverId').val(receiverID);
        $('#receiverType').val(receiverType); // Set receiver type
        $('#fullName').val(fullName);
        $('#suggestions').hide();
        console.log('Hidden input fields set:', $('#receiverId').val(), $('#receiverType').val(), $('#fullName').val());
    });

    // Add a submit event listener to the form to ensure the receiverId is set
    $('form').on('submit', function(event) {
        // Check if the submit button is the logout button
        if ($(document.activeElement).attr('id') === 'logoutButton') {
            return; // Allow the logout form to submit without validation
        }

        var receiverID = $('#receiverId').val();
        var receiverType = $('#receiverType').val();
        if (!receiverID || receiverID === 'undefined' || !receiverType || receiverType === 'undefined') {
            event.preventDefault(); // Prevent form submission
            alert('Please select a valid receiver from the suggestions.');
            console.log('Form submission prevented, receiverId or receiverType is invalid:', receiverID, receiverType); // Debugging output
        } else {
            console.log('Form submitted with receiverId:', receiverID, 'and receiverType:', receiverType); // Debugging output
        }
    });
});
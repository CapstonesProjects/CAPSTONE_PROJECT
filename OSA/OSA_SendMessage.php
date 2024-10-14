<?php
session_start();
include('../config/db_connection.php');

if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    $query = "SELECT FirstName, LastName FROM tblusers_osa WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
} else {
    // Redirect to login page or show an error
    header("Location: login.php");
    exit();
}

include('../alerts/send_message.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/student_profile.css">
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <title>OSA Send Message - LOA OSA</title>
</head>

<body class="font-poppins antialiased bg-gray-200">
    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'send_message';
            include('../components/osa_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            <?php include('../components/OSA_SendMessage.php') ?>
        </div>
    </div>

   
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../javascript/sessionmessage.js"></script>
<script src="../javascript/active.js"></script>


<script>
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


</script>

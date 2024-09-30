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
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Messages</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Sent Messages</h1>
        <ul id="sent-messages-list">
    
        </ul>
    </div> -->
<!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('../phpfiles/fetch_sent_messages.php')
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById('sent-messages-list');
                    if (data.error) {
                        list.innerHTML = `<li class="text-red-500">${data.error}</li>`;
                    } else {
                        data.forEach(message => {
                            const listItem = document.createElement('li');
                            listItem.classList.add('flex', 'items-center', 'border-y', 'hover:bg-gray-200', 'px-2');
                            listItem.innerHTML = `
                                <div class="w-full flex items-center justify-between p-1 my-1 cursor-pointer">
                                    <div class="flex items-center">
                                        <span class="w-56 pr-2 font-bold truncate">${message.sender}</span>
                                        <span class="w-64 font-bold truncate">${message.subject}</span>
                                        <span class="mx-1">-</span>
                                        <span class="w-96 text-gray-600 text-sm truncate">${message.body}</span>
                                    </div>
                                    <div class="w-32 flex items-center justify-end">
                                        <span class="text-sm font-bold">${message.time}</span>
                                    </div>
                                </div>
                            `;
                            list.appendChild(listItem);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching sent messages:', error);
                    const list = document.getElementById('sent-messages-list');
                    list.innerHTML = `<li class="text-red-500">Error fetching sent messages: ${error.message}</li>`;
                });
        });
    </script> -->
<!-- </body>
</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/student_profile.css">
    <link rel="shortcut icon" href="../images/osa_logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
</head>

<body>



    <div class="flex h-screen">
        <div class="h-full shadow-xl overflow-x-hidden transition-transform duration-300 ease-in-out">
            <?php
            $activeMenu = 'send_message';
            include('../components/osa_sidebar.php');
            ?>
        </div>
        <div class="flex justify-center items-center">
            <?php include '../components/message_sidebar_osa.php'; ?>
            <div class="bg-gray-100 mb-6">
                <div class="overflow-y-auto" style="max-height: 840px;">
                    <ul>
                        <!-- Repeat the message list items here with the same styling as Inbox -->
                        <li class="flex items-center border-y hover:bg-gray-200 px-2">
                            <input type="checkbox" class="focus:ring-0 border-2 border-gray-400" :checked="checkAll">
                            <div x-data="{ messageHover: false }" @mouseover="messageHover = true" @mouseleave="messageHover = false" class="w-full flex items-center justify-between p-1 my-1 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="flex items-center mr-4 ml-1 space-x-1">
                                        <button title="Not starred">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <span class="w-56 pr-2 truncate">William Livingston</span>
                                    <span class="w-64 truncate">Lorem ipsum dolor sit amet</span>
                                    <span class="mx-1">-</span>
                                    <span class="w-96 text-gray-600 text-sm truncate">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</span>
                                </div>
                                <div class="w-32 flex items-center justify-end">
                                    <div x-show="messageHover" class="flex items-center space-x-2" style="display: none;">
                                        <button title="Archive">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                                            </svg>
                                        </button>
                                        <button title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                        <button title="Mark As Unread">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                        <button title="Snooze">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <span x-show="!messageHover" class="text-sm text-gray-500">
                                        3:05 PM
                                    </span>
                                </div>
                            </div>
                        </li>
                        <!-- Repeat for other messages -->
                    </ul>
                </div>
            </div>
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
                    data: {
                        StudentID: query
                    },
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
            var studentID = $(this).data('student-id'); // Extract the StudentID from the data attribute
            console.log('Suggestion clicked:', fullName, 'StudentID:', studentID); // Debugging output
            $('#to').val(fullName); // Set the input field with the full name only
            $('#studentId').val(studentID); // Set the hidden input field with the StudentID
            $('#suggestions').hide();
            console.log('Hidden input field set:', $('#studentId').val()); // Debugging output
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

</html>


<!-- 
<div class="bg-gray-100 mb-6">
            <div class="overflow-y-auto" style="max-height: 840px;">
                <ul>
                    <li class="flex items-center border-y hover:bg-gray-200 px-2">
                        <input type="checkbox" class="focus:ring-0 border-2 border-gray-400" :checked="checkAll">
                        <div x-data="{ messageHover: false }" @mouseover="messageHover = true" @mouseleave="messageHover = false" class="w-full flex items-center justify-between p-1 my-1 cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex items-center mr-4 ml-1 space-x-1">
                                    <button title="Not starred">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </button>

                                </div>
                                <span class="w-56 pr-2 truncate">William Livingston</span>
                                <span class="w-64 truncate">Lorem ipsum dolor sit amet</span>
                                <span class="mx-1">-</span>
                                <span class="w-96 text-gray-600 text-sm truncate">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</span>
                            </div>
                            <div class="w-32 flex items-center justify-end">
                                <div x-show="messageHover" class="flex items-center space-x-2" style="display: none;">
                                    <button title="Archive">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                                        </svg>
                                    </button>
                                    <button title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    <button title="Mark As Unread">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    <button title="Snooze">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <span x-show="!messageHover" class="text-sm text-gray-500">
                                    3:05 PM
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="flex items-center border-y hover:bg-gray-200 px-2">
                        <input type="checkbox" class="focus:ring-0 border-2 border-gray-400" :checked="checkAll">
                        <div x-data="{ messageHover: false }" @mouseover="messageHover = true" @mouseleave="messageHover = false" class="w-full flex items-center justify-between p-1 my-1 cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex items-center mr-4 ml-1 space-x-1">
                                    <button title="Starred">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 hover:text-yellow-600 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </button>

                                </div>
                                <span class="w-56 pr-2 font-bold truncate">Betty Garmon</span>
                                <span class="w-64 font-bold truncate">Consectetur adipiscing elit</span>
                                <span class="mx-1">-</span>
                                <span class="w-96 text-gray-600 text-sm truncate">Ccusantium doloremque laudantium, totam rem aperiam, eaque ipsa</span>
                            </div>
                            <div class="w-32 flex items-center justify-end">
                                <div x-show="messageHover" class="flex items-center space-x-2" style="display: none;">
                                    <button title="Archive">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                                        </svg>
                                    </button>
                                    <button title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    <button title="Mark As Read">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                                        </svg>
                                    </button>
                                    <button title="Snooze">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <span x-show="!messageHover" class="text-sm font-bold">
                                    1:23 PM
                                </span>
                            </div>
                        </div>
                    </li>
                    <li class="flex items-center border-y hover:bg-gray-200 px-2">
                        <input type="checkbox" class="focus:ring-0 border-2 border-gray-400" :checked="checkAll">
                        <div x-data="{ messageHover: false }" @mouseover="messageHover = true" @mouseleave="messageHover = false" class="w-full flex items-center justify-between p-1 my-1 cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex items-center mr-4 ml-1 space-x-1">
                                    <button title="Starred">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 hover:text-yellow-600 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </button>

                                </div>
                                <span class="w-56 pr-2 font-bold truncate">Elsa J. Collins</span>
                                <span class="w-64 font-bold truncate">Sed do eiusmod tempor incididunt</span>
                                <span class="mx-1">-</span>
                                <span class="w-96 text-gray-600 text-sm truncate">Quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</span>
                            </div>
                            <div class="w-32 flex items-center justify-end">
                                <div x-show="messageHover" class="flex items-center space-x-2" style="display: none;">
                                    <button title="Archive">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                                        </svg>
                                    </button>
                                    <button title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    <button title="Mark As Read">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                                        </svg>
                                    </button>
                                    <button title="Snooze">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <span x-show="!messageHover" class="text-sm font-bold">
                                    Jan 29
                                </span>
                            </div>
                        </div>
                    </li>
                </ul
            </div> -->
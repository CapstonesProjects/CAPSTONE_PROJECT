<?php

include('../config/db_connection.php');

// Check if the user is logged in and has an OSA_number
if (!isset($_SESSION['OSA_number'])) {
    echo "OSA number not set in session";
    exit;
}

$osaNumber = $_SESSION['OSA_number'];

// Query to get the sent messages for the logged-in user
$query = "SELECT * FROM messages WHERE sender = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $osaNumber);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="overflow-y-auto" style="max-height: 840px;">
    <ul>
        <?php while ($message = $result->fetch_assoc()): ?>
            <li class="flex items-center border-y hover:bg-gray-200 px-2 message-container">
                <input type="checkbox" class="focus:ring-0 border-2 border-gray-400">
                <div x-data="{ messageHover: false }" @mouseover="messageHover = true" @mouseleave="messageHover = false" class="w-full flex items-center justify-between p-1 my-1 cursor-pointer messages-item">
                    <div class="flex items-center">
                        <div class="flex items-center mr-4 ml-1 space-x-1">
                            <button title="Not starred">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </button>
                        </div>
                        <span class="w-72 pr-2 truncate"><?php echo htmlspecialchars($message['FullNameReceiver'] ?? 'Unknown Receiver') . ' (' . htmlspecialchars($message['receiver'] ?? 'Unknown Receiver') . ')'; ?></span>
                        <span class="w-48 truncate ml-4"><?php echo htmlspecialchars($message['subject'] ?? 'No Subject'); ?></span>
                        <span class="mx-1">-</span>
                        <span class="w-64 text-gray-600 text-sm truncate ml-4"><?php echo htmlspecialchars($message['body'] ?? 'No Body'); ?></span>
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
                        <span x-show="!messageHover" class="text-sm">
                            <?php
                            if (isset($message['created_at']) && !is_null($message['created_at'])) {
                                $currentDate = new DateTime();
                                $messageDate = new DateTime($message['created_at']);
                                $interval = $currentDate->diff($messageDate);

                                if ($interval->days < 1) {
                                    // Format the date as "hour:minute AM/PM"
                                    echo htmlspecialchars($messageDate->format('g:i A'));
                                } else {
                                    // Format the date as "date month"
                                    echo htmlspecialchars($messageDate->format('j F'));
                                }
                            } else {
                                echo 'Unknown Date';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<style>
    #details-body {
        font-family: 'Courier New', Courier, monospace;
        white-space: pre-wrap; /* Preserve whitespace and line breaks */
        margin-left: 20px; /* Indent the body text */
    }
</style>

<!-- Dedicated Section for Message Details -->
<div id="message-details" class="bg-white shadow-lg rounded-lg overflow-hidden" style="display: none;">
    <div class="p-6">
        <h4 class="text-lg text-gray-800 font-bold pb-2 mb-4 border-b-2">Message Details</h4>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/message3.jpg" class="rounded-full w-8 h-8 border border-gray-500" id="details-avatar">
                <div class="flex flex-col ml-2">
                    <span class="text-sm font-semibold" id="details-receiver"></span>
                    <span class="text-xs text-gray-400">Subject: <span id="details-subject"></span></span>
                </div>
            </div>
            <span class="text-sm text-gray-500" id="details-date"></span>
        </div>
        <div class="py-6 pl-2 text-gray-700">
            <p id="details-body">Message body content will go here...</p>
        </div>
        <div class="border-t-2 flex space-x-4 py-4">
            <button id="close-details" class="w-32 flex items-center justify-center space-x-2 py-1.5 text-gray-600 border border-gray-400 rounded-lg hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>Close</span>
            </button>
        </div>
    </div>
</div>

<?php
$stmt->close();
$conn->close();
?>

<!-- Dedicated Section for Message Details -->
<!-- <div id="message-details" class="bg-white shadow-lg rounded-lg overflow-hidden" style="display: none;">
    <div class="p-6">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Message Details</h2>
            <button id="close-details" class="text-gray-500 hover:text-gray-900 text-2xl">&times;</button>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-500"><strong>Receiver:</strong></p>
            <p id="details-receiver" class="text-lg text-gray-700"></p>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-500"><strong>Subject:</strong></p>
            <p id="details-subject" class="text-lg text-gray-700"></p>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-500"><strong>Body:</strong></p>
            <p id="details-body" class="text-lg text-gray-700 whitespace-pre-wrap"></p>
        </div>
        <div class="flex justify-end">
            <button id="close-details" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Close</button>
        </div>
    </div>
</div> -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageContainers = document.querySelectorAll('.message-container');
    const messageDetails = document.getElementById('message-details');
    const detailsReceiver = document.getElementById('details-receiver');
    const detailsSubject = document.getElementById('details-subject');
    const detailsBody = document.getElementById('details-body');
    const closeDetails = document.getElementById('close-details');

    messageContainers.forEach(container => {
        container.addEventListener('click', function() {
            const receiver = this.querySelector('.w-72').textContent;
            const subject = this.querySelector('.w-48').textContent;
            const body = this.querySelector('.w-64').textContent;
            // const createdAt = this.querySelector('.text-sm').dataset.createdAt;
            // const avatar = this.querySelector('img').src;

            // // Format the date
            // const currentDate = new Date();
            // const messageDate = new Date(createdAt);
            // const interval = Math.floor((currentDate - messageDate) / (1000 * 60 * 60 * 24));

            // let formattedDate;
            // if (interval < 1) {
            //     formattedDate = messageDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
            // } else {
            //     formattedDate = messageDate.toLocaleDateString([], { day: 'numeric', month: 'long' });
            // }

            // Populate the details section with the message content
            detailsReceiver.textContent = receiver;
            detailsSubject.textContent = subject;
            detailsBody.textContent = body;

            // Hide all message containers
            messageContainers.forEach(c => c.style.display = 'none');

            // Show the details section
            messageDetails.style.display = 'block';
        });
    });

    closeDetails.addEventListener('click', function() {
        // Hide the details section
        messageDetails.style.display = 'none';

        // Show all message containers
        messageContainers.forEach(c => c.style.display = 'flex');
    });
});
</script>
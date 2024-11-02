<?php
include('../config/db_connection.php');

// Check if the user is logged in and has an AdminNumber
if (!isset($_SESSION['AdminNumber'])) {
    echo "Admin number not set in session";
    // Optionally, redirect to a login page or handle the error appropriately without exiting.
    exit;
}

$adminNumber = $_SESSION['AdminNumber'];

// Query to get the inbox messages for the logged-in user
$query = "SELECT * FROM messages WHERE receiver = ? AND receiverType = 'Admin' ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $adminNumber);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="overflow-y-auto" style="max-height: 840px;">
    <ul>
        <?php while ($message = $result->fetch_assoc()): ?>
            <li class="flex items-center border-y hover:bg-gray-200 px-2 message-container" data-date="<?php echo htmlspecialchars($message['created_at']); ?>" data-sender="<?php echo htmlspecialchars($message['FullNameSender'] ?? 'Unknown Sender'); ?>" data-subject="<?php echo htmlspecialchars($message['subject'] ?? 'No Subject'); ?>" data-body="<?php echo htmlspecialchars($message['body'] ?? 'No Body'); ?>">
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
                        <span class="w-72 pr-2 truncate"><?php echo htmlspecialchars($message['FullNameSender'] ?? 'Unknown Sender') . ' (' . htmlspecialchars($message['sender'] ?? 'Unknown Sender') . ')'; ?></span>
                        <span class="w-48 truncate ml-4"><?php echo htmlspecialchars($message['subject'] ?? 'No Subject'); ?></span>
                        <span class="mx-1">-</span>
                        <span class="w-64 text-gray-600 text-sm truncate ml-4"><?php echo htmlspecialchars($message['body'] ?? 'No Body'); ?></span>
                    </div>
                    <div class="w-32 flex items-center justify-end">
                        <div x-show="messageHover" class="flex items-center space-x-2" style="display: none;">
                            <!-- Action buttons SVGs -->
                        </div>
                        <span x-show="!messageHover" class="text-sm">
                            <?php
                            if (!empty($message['created_at'])) {
                                $currentDate = new DateTime();
                                $messageDate = new DateTime($message['created_at']);
                                $interval = $currentDate->diff($messageDate);

                                if ($interval->days < 1) {
                                    echo htmlspecialchars($messageDate->format('g:i A'));
                                } else {
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
        white-space: pre-wrap;
        margin-left: 20px;
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
                    <span class="text-sm font-semibold" id="details-sender"></span>
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
                <!-- Close icon SVG -->
                <span>Close</span>
            </button>
        </div>
    </div>
</div>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messageContainers = document.querySelectorAll('.message-container');
        const messageDetails = document.getElementById('message-details');
        const detailsSender = document.getElementById('details-sender');
        const detailsSubject = document.getElementById('details-subject');
        const detailsBody = document.getElementById('details-body');
        const detailsDate = document.getElementById('details-date');
        const closeDetails = document.getElementById('close-details');

        messageContainers.forEach(container => {
            container.addEventListener('click', function() {
                const sender = this.getAttribute('data-sender');
                const subject = this.getAttribute('data-subject');
                const body = this.getAttribute('data-body');
                const date = this.getAttribute('data-date');

                // Format the date
                const messageDate = new Date(date);
                const formattedDate = messageDate.toLocaleString('en-US', {
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true,
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });

                // Populate the details section with the message content
                detailsSender.textContent = sender;
                detailsSubject.textContent = subject;
                detailsBody.textContent = body;
                detailsDate.textContent = formattedDate;

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
<?php if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    $query = "SELECT * FROM tblusers_osa WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
    $_SESSION['Role'] = $user['Role'];
    $_SESSION['OSA_number'] = $user['OSA_number'];
    $_SESSION['FullNameSender'] = $user['FirstName'] . ' ' . $user['LastName']; 
} else {
    // Redirect to login page or show an error
} ?>

<div id="composeWindow" class="fixed bottom-0 right-0 bg-white shadow-lg rounded-lg p-4 w-1/4 h-auto hidden">
    <div class="flex justify-between items-center border-b pb-2 mb-2">
        <h2 class="text-lg font-semibold">New Message</h2>
        <button id="closeCompose" class="text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <form method="POST" action="../phpfiles/sendmessage.php">
        <div class="mb-2">
            <input type="text" name="to" id="to" class="w-full text-gray-700 py-1 border-b border-b-gray-300 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="To">
            <div id="suggestions" class="bg-white border border-gray-300 mt-1 rounded-lg shadow-lg hidden"></div>
        </div>
        <input type="hidden" name="studentId" id="studentId"> <!-- Hidden input for StudentID -->
        <input type="hidden" name="fullName" id="fullName"> <!-- Hidden input for FullName -->
        <input type="hidden" name="fullNameSender" id="fullNameSender" value="<?php echo $_SESSION['FullNameSender']; ?>"> 

        <div class="mb-2">
            <input type="text" name="subject" id="subject" class="w-full text-gray-700 py-1 border-b border-b-gray-300 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="Subject">
        </div>
        <div class="mt-2" style="margin-bottom: -184px;">
            <textarea name="body" id="body" class="w-full h-96 max-h-96 text-gray-700 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="Message..."></textarea>
        </div>
        <div class="flex items-center justify-between mt-0" style="margin-top: -181px; margin-bottom: 10px;">
            <div class="flex items-center space-x-1 mt-0 p-0">
                <button type="button" class="bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1 text-gray-100 hover:shadow-xl transition duration-150" onclick="insertTemplate()">Summon Template</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1 text-gray-100 hover:shadow-xl transition duration-150">Send</button>
                <button title="Attach Files" class="p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M4.222 19.778a4.983 4.983 0 0 0 3.535 1.462 4.986 4.986 0 0 0 3.536-1.462l2.828-2.829-1.414-1.414-2.828 2.829a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.829-2.828-1.414-1.414-2.829 2.828a5.006 5.006 0 0 0 0 7.071zm15.556-8.485a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0L9.879 7.051l1.414 1.414 2.828-2.829a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.829 2.828 1.414 1.414 2.829-2.828z"></path>
                        <path d="m8.464 16.95-1.415-1.414 8.487-8.486 1.414 1.415z"></path>
                    </svg>
                </button>
            </div>
            <button class="text-gray-700 hover:text-gray-900 p-1" title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                    <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
 
<script>
    function insertTemplate() {
        const template = `
            Dear [Recipient Name],

            I hope this message finds you well. I am writing to inform you about [Subject].

            [Body of the letter]

            Best regards,
            [Your Name]
        `;
        document.getElementById('body').value = template;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const composeButton = document.getElementById('composeButton');
        const composeWindow = document.getElementById('composeWindow');
        const closeCompose = document.getElementById('closeCompose');

        composeButton.addEventListener('click', function(event) {
            event.preventDefault();
            composeWindow.classList.remove('hidden');
        });

        closeCompose.addEventListener('click', function() {
            composeWindow.classList.add('hidden');
        });
    });
</script>
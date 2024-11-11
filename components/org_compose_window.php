<?php if (isset($_SESSION['OrgID'])) {
    $orgId = $_SESSION['OrgID'];

    $query = "SELECT * FROM tblusers_organization WHERE OrgID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orgId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $_SESSION['FirstName'] = $user['FirstName'];
    $_SESSION['LastName'] = $user['LastName'];
    $_SESSION['Role'] = $user['Role'];
    $_SESSION['Org_number'] = $user['Org_number'];
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
    <form method="POST" action="../phpfiles/sendmessage_org.php" enctype="multipart/form-data">
        <div class="mb-2">
            <input type="text" name="to" id="to" class="w-full text-gray-700 py-1 border-b border-b-gray-300 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="To">
            <div id="suggestions" class="bg-white border border-gray-300 mt-1 rounded-lg shadow-lg hidden"></div>
        </div>
        <input type="hidden" name="receiverId" id="receiverId"> <!-- Hidden input for ReceiverID -->
        <input type="hidden" name="receiverType" id="receiverType"> <!-- Hidden input for ReceiverType -->
        <input type="hidden" name="fullName" id="fullName"> <!-- Hidden input for FullName -->
        <input type="hidden" name="fullNameSender" id="fullNameSender" value="<?php echo $_SESSION['FullNameSender']; ?>">

        <div class="mb-2">
            <input type="text" name="subject" id="subject" class="w-full text-gray-700 py-1 border-b border-b-gray-300 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="Subject">
        </div>
        <div class="mt-2" style="margin-bottom: -184px;">
            <textarea name="body" id="body" class="w-full h-96 max-h-96 text-gray-700 focus:outline-none focus:ring-0 focus:border-transparent focus:border-b-gray-300" placeholder="Message..."></textarea>
        </div>
        <div class="preview-container" style="margin-bottom: -35%; max-height: 200px; height: 200px;">
            <div id="filePreview" class="mt-2 flex flex-col-reverse gap-2 overflow-auto max-w-full" style="height: 200px;"></div>
        </div>
        <div class="flex items-center justify-between mt-0" style="margin-top: -181px; margin-bottom: 10px;">
            <div class="flex items-center space-x-1 mt-0 p-0">
                <button type="button" class="bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1 text-gray-100 hover:shadow-xl transition duration-150" onclick="insertTemplate()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z"></path>
                    </svg>
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1 text-gray-100 hover:shadow-xl transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                        <path d="m21.426 11.095-17-8A.999.999 0 0 0 3.03 4.242L4.969 12 3.03 19.758a.998.998 0 0 0 1.396 1.147l17-8a1 1 0 0 0 0-1.81zM5.481 18.197l.839-3.357L12 12 6.32 9.16l-.839-3.357L18.651 12l-13.17 6.197z"></path>
                    </svg>
                </button>
                <div class="relative">
                    <button type="button" title="Attach Files" class="p-1" onclick="document.getElementById('fileInput').click(); event.stopPropagation();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M4.222 19.778a4.983 4.983 0 0 0 3.535 1.462 4.986 4.986 0 0 0 3.536-1.462l2.828-2.829-1.414-1.414-2.828 2.829a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.829-2.828-1.414-1.414-2.829 2.828a5.006 5.006 0 0 0 0 7.071zm15.556-8.485a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0L9.879 7.051l1.414 1.414 2.828-2.829a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.829 2.828 1.414 1.414 2.829-2.828z"></path>
                            <path d="m8.464 16.95-1.415-1.414 8.487-8.486 1.414 1.415z"></path>
                        </svg>
                    </button>
                    <input type="file" id="fileInput" name="attachments[]" class="hidden" multiple onchange="previewFiles()">
                </div>
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
    function previewFiles() {
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');

        const files = fileInput.files;
        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.classList.add('relative', 'flex', 'items-center', 'justify-between', 'p-2', 'border', 'rounded', 'bg-gray-100', 'w-full', 'h-10');

                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;
                    fileName.classList.add('text-gray-700', 'truncate', 'mr-2');
                    fileName.style.maxWidth = 'calc(100% - 2rem)'; // Adjust max width to leave space for the remove button

                    const removeButton = document.createElement('button');
                    removeButton.classList.add('absolute', 'right-2', 'bg-none', 'border-none', 'cursor-pointer', 'text-lg', 'text-red-500', 'font-bold');
                    removeButton.style.top = '-12rem'; // Inline style for top positioning
                    removeButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 001.414 1.414L10 11.414l2.293 2.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293z" clip-rule="evenodd" />
                        </svg>
                    `;
                    removeButton.onclick = function() {
                        preview.remove();
                    };

                    preview.appendChild(fileName);
                    preview.appendChild(removeButton);
                    filePreview.appendChild(preview);
                };

                reader.readAsDataURL(file);
            });
        }
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

        // Prevent default behavior for file input click
        document.getElementById('fileInput').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
</script>
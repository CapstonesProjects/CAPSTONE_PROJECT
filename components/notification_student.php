<!-- component -->
<div class="custom-div">
<div class="w-full bg-gray-200 shadow-xl rounded-lg flex overflow-x-auto custom-scrollbar pl-5 pr-5" style="width: 1598px; height: 905px;">
    <div class="flex-1" x-data="{ checkAll: false, filterMessages: false }">
        <div class="h-16  flex items-center justify-between">
            <div class="flex items-center p-5">
                <div class="relative flex items-center px-0.5 space-x-0.5">
                    
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <button title="Reload" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>
                    <div class="flex items-center space-x-2">
                        <button title="Mark As Read" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                            </svg>
                        </button>
                        <button title="Mark As Unread" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="inbox-content" class="bg-gray-100 sections" style="display: block;">
            <?php include('inbox_content_student.php'); ?>
        </div>

        

    </div>
</div>
</div>
<!-- 
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inboxLink = document.getElementById('inbox-link');
    const sentLink = document.getElementById('sent-link');
    const inboxContent = document.getElementById('inbox-content');
    const sentContent = document.getElementById('sent-content');

    inboxLink.addEventListener('click', function() {
        inboxContent.style.display = 'block';
        sentContent.style.display = 'none';
        inboxLink.classList.add('bg-gray-500', 'bg-opacity-30', 'text-blue-600');
        sentLink.classList.remove('bg-gray-500', 'bg-opacity-30', 'text-blue-600');
    });

    sentLink.addEventListener('click', function() {
        sentContent.style.display = 'block';
        inboxContent.style.display = 'none';
        sentLink.classList.add('bg-gray-500', 'bg-opacity-30', 'text-blue-600');
        inboxLink.classList.remove('bg-gray-500', 'bg-opacity-30', 'text-blue-600');
    });
});
</script> -->


<style>
    .section {
        display: none;
    }
    .section:not(.hidden) {
        display: block;
    }
    .nav-link.active {
        font-weight: bold;
    }
</style>

<div class="px-2 pt-4 pb-8 border-r border-gray-300">
    <ul class="space-y-2">
        <li>
            <a id="inbox-link" class="nav-linkss bg-gray-500 bg-opacity-30 text-blue-600 flex items-center justify-between py-1.5 px-4 rounded cursor-pointer" data-section="inboxSection">
                <span class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <span>Inbox</span>
                </span>
                <span class="bg-sky-500 text-gray-100 font-bold px-2 py-0.5 text-xs rounded-lg">3</span>
            </a>
        </li>
        <li>
            <a class="nav-link hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer" data-section="starredSection">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
                <span>Starred</span>
            </a>
        </li>
        <li>
            <a id="sent-link" class="nav-linkss hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer" data-section="sentSection">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                <span>Sent</span>
            </a>
        </li>
        <li>
            <a id="drafts-link" class="nav-link hover:bg-gray-500 hover:bg-opacity-10 hover:text-blue-600 flex items-center justify-between text-gray-700 py-1.5 px-4 rounded space-x-2 cursor-pointer" data-section="draftsSection">
                <span class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Drafts</span>
                </span>
                <span class="bg-sky-500 text-gray-100 font-bold px-2 py-0.5 text-xs rounded-lg">1</span>
            </a>
        </li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Save the current section in local storage
        const navLinks = document.querySelectorAll('.nav-linkss');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                const section = this.getAttribute('data-section');
                console.log('Saving section:', sections);
                localStorage.setItem('currentSection', section);
            });
        });

        // Retrieve the current section from local storage and display it
        const currentSection = localStorage.getItem('currentSection');
        console.log('Current section from local storage:', currentSection);
        if (currentSection) {
            document.querySelectorAll('.sections').forEach(section => {
                sections.style.display = 'none';
            });
            const sectionElement = document.getElementById(currentSection);
            if (sectionElement) {
                sectionElement.style.display = 'block';
            } else {
                console.error('Section element not found:', currentSection);
            }

            // Update the active nav link
            // navLinks.forEach(link => {
            //     link.classList.remove('active');
            //     if (link.getAttribute('data-section') === currentSection) {
            //         link.classList.add('active');
            //     }
            // });
        } else {
            // Default to showing the inbox section if no section is stored
            document.querySelectorAll('.section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById('inbox-content').style.display = 'block';
            document.getElementById('inbox-link').classList.add('active');
        }
    });
</script>
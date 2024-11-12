<div class="modal fade" id="ChangePasswordModal<?php echo $_SESSION['UserID']; ?>" tabindex="-1" role="dialog" aria-labelledby="ChangePasswordModalLabel<?php echo $_SESSION['UserID']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-xl font-medium text-gray-900" id="ChangePasswordModalLabel<?php echo $_SESSION['UserID']; ?>">Change Password</h5>
                <button type="button" class="text-gray-400 hover:text-gray-500" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <!-- Dropdown Menu -->
                <div class="mb-4">
                    <label for="settings-dropdown" class="block text-sm font-medium text-gray-700">Select Setting</label>
                    <select id="settings-dropdown" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Choose</option>
                        <option value="password">Change Password</option>
                        <option value="email">Change Email</option>
                        <option value="theme">Theme</option>
                    </select>
                </div>
                <!-- Change Password Section -->
                <form id="password-section" class="settings-section hidden border-t border-gray-200 pt-4 mt-4" action="../phpfiles/osa_update_password.php" method="post">
                    <h6 class="text-lg font-semibold text-gray-700">Change Password</h6>
                    <div class="mt-2">
                        <label for="current-password" class="block text-sm font-medium text-gray-700">Current Password</label>
                        <input type="password" id="current-password" name="current-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mt-2">
                        <label for="new-password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" id="new-password" name="new-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mt-2">
                        <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Changes</button>
                    </div>
                </form>
                <!-- Change Email Section -->
                <form id="email-section" class="settings-section hidden border-t border-gray-200 pt-4 mt-4" action="../phpfiles/student_update_email.php" method="post">
                    <h6 class="text-lg font-semibold text-gray-700">Change Email</h6>
                    <div class="mt-2">
                        <label for="current-email" class="block text-sm font-medium text-gray-700">Current Email</label>
                        <input type="email" id="current-email" name="current-email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo $_SESSION['Email']; ?>" readonly>
                    </div>
                    <div class="mt-2">
                        <label for="new-email" class="block text-sm font-medium text-gray-700">New Email</label>
                        <input type="email" id="new-email" name="new-email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Changes</button>
                    </div>
                </form>
                <!-- Theme Selection Section -->
                <form id="theme-section" class="settings-section hidden border-t border-gray-200 pt-4 mt-4" action="../phpfiles/student_update_theme.php" method="post">
                    <h6 class="text-lg font-semibold text-gray-700">Theme</h6>
                    <div class="mt-2">
                        <div class="flex items-center">
                            <input id="light-theme" name="theme" type="radio" value="light" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                            <label for="light-theme" class="ml-3 block text-sm font-medium text-gray-700">Light</label>
                        </div>
                        <div class="flex items-center mt-2">
                            <input id="dark-theme" name="theme" type="radio" value="dark" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="dark-theme" class="ml-3 block text-sm font-medium text-gray-700">Dark</label>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const settingsDropdown = document.getElementById('settings-dropdown');
        const sections = document.querySelectorAll('.settings-section');

        settingsDropdown.addEventListener('change', function() {
            sections.forEach(section => {
                section.classList.add('hidden');
            });

            const selectedSection = document.getElementById(`${this.value}-section`);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');
            }
        });
    });
</script>
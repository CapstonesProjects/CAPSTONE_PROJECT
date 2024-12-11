<div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50" id="changePasswordModal">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto max-h-screen overflow-y-auto p-4 sm:p-6 md:p-8">
        <div class="flex justify-between items-center bg-teal-500 text-white p-3 rounded-t-lg">
            <h5 class="text-lg font-semibold" id="changePasswordModalLabel">Change Default Password</h5>
        </div>
        <div class="p-4">
            <p class="mb-4 text-red-600 font-semibold">This action is required. Please change your default password to continue.</p>
            <p class="mb-4 text-gray-700">Your current password is the default password. Please change it to a new password.</p>
            <form id="changePasswordForm" action="../phpfiles/student_change_default_password.php" method="post">
                <div class="mb-3">
                    <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current Password</label>
                    <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-200 cursor-not-allowed focus:ring-teal-500 focus:border-teal-500 sm:text-sm p-2" id="currentPassword" name="currentPassword" value="<?php echo isset($_SESSION['default_password']) ? $_SESSION['default_password'] : ''; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm p-2" id="newPassword" name="newPassword" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input type="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm p-2" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
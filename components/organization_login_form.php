<section>
    <div class="parent-container">
        <div class="login-form-container">
            <div class="login_form_card">
                <form id="loginForm" action="./Login/Organization_Login.php" method="POST">
                    <div class="login-text-title">
                        <h2 class="text-2xl font-bold">Login</h2>
                        <h4 class="mt-1 text-sm">Welcome Back, Please Login To Your Organization Account.</h4>
                    </div>

                    <div class="text-box-container">
                        <div class="text-box mb-4">
                            <label for="username" class="block text-sm font-medium text-white">Username</label>
                            <input type="text" name="username" id="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
                        <div class="text-box mb-4">
                            <label for="password" class="block text-sm font-medium text-white">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>

                        <div class="links-container">
                            <label style="font-size: 0.8rem;">
                                <input type="checkbox" name="remember_me">
                                Remember me
                            </label>
                            <a href="#" class=" text-white hover:text-indigo-500 float-right" style="font-size: 0.8rem;">Forgot Password?</a>
                        </div>

                        <div class="btn-container mb-4">
                            <button type="submit" class=" bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded shadow-lg transition duration-300 ease-in-out transform hover:scale-105" style="width: 530px;">Login</button>
                        </div>

                        <?php if (isset($_SESSION['login_attempts']) && isset($_SESSION['login_username']) && isset($_SESSION['login_username'])): ?>
                            <div class="flex flex-col justify-center items-center text-white space-x-2">
                                <span><?php echo "You have " . (3 - $_SESSION['login_attempts']) . " attempts left."; ?></span>
                                <?php if (isset($_SESSION['login_email'])): ?>
                                    <span><?php echo "Email: " . $_SESSION['login_email']; ?></span>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['login_username'])): ?>
                                    <span><?php echo "Username: " . $_SESSION['login_username']; ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</section>
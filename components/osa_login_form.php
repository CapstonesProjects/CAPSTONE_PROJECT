<div class="parent-container">
    <div class="login-form-container">
        <div class="login_form_card">
            <form id="loginForm" action="./Login/OSA_Login.php" method="POST">
                <div class="login-text-title">
                    <h2 style="font-size: 2.3rem;">Login</h2>
                    <h4 class="mt-1" style="font-size: 0.8rem;">Welcome Back, Please Login To Your OSA Account.</h4>
                </div>

                <div class="text-box-container">
                    <div class="text-box">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="text-box">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="links-container">
                        <label>
                            <input type="checkbox" name="remember_me">
                            Remember me
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <div class="btn-container">
                        <button class="login-btn">Login</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
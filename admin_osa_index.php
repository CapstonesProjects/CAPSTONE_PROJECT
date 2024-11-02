<?php
session_start();
include('./config/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/admin_index.css">
  <link rel="shortcut icon" href="images/osa_logo.png" type="image/x-icon">
  <title>Admin - LOA Office of Student Affairs</title>
</head>

<style>
  .loading-screen {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    justify-content: center;
    align-items: center;
  }

  .loading-spinner {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

<body>

  <div class="loading-screen" id="loadingScreen">
    <div class="loading-spinner"></div>
  </div>

  <div class="relative min-h-screen flex ">
    <div class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
      <div class="sm:w-1/2 xl:w-3/5 h-full hidden md:flex flex-auto items-center justify-center p-10 overflow-hidden bg-purple-900 text-white bg-no-repeat bg-cover relative"
        style="background-image: url(images/index-background.png);">
        <div class="absolute bg-gradient-to-b from-indigo-600 to-blue-500 opacity-75 inset-0 z-0"></div>
        <div class="w-full  max-w-md z-10">
          <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6 whitespace-nowrap">Office of Student Affairs <br> in <span class="text-red-400">Lyceum of Alabang</span></div>
          <div class="sm:text-sm xl:text-md text-gray-200 font-normal"> What is Lorem Ipsum Lorem Ipsum is simply dummy
            text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever
            since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it
            has?</div>
        </div>

        <ul class="circles">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>
      <div class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white">
        <div class="max-w-md w-full space-y-8">
          <div class="text-center">
            <h2 class="mt-6 text-3xl font-bold text-gray-900">
              Welcome Back!
            </h2>
            <p class="mt-2 text-sm text-gray-500">Please sign in to your account</p>

            <?php if (isset($_SESSION['login_error'])): ?>
              <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['login_error'];
                                              unset($_SESSION['login_error']); ?></span>
              </div>
            <?php endif; ?>

            <form id="loginForm" class="mt-8 space-y-6" action="Login/OSA_Admin_Login.php" method="POST">
              <input type="hidden" name="remember" value="true">
              <div class="relative">
                <div class="absolute right-3 mt-4">

                </div>
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Username</label>
                <input
                  class="w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                  type="text" name="username" placeholder="Enter your username" required>
              </div>
              <div class="mt-8 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Password
                </label>
                <input
                  class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500"
                  type="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input id="remember_me" name="remember_me" type="checkbox"
                    class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded">
                  <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                    Remember me
                  </label>
                </div>
                <div class="text-sm">
                  <a href="#" class="text-indigo-400 hover:text-blue-500">
                    Forgot your password?
                  </a>
                </div>
              </div>
              <div>
                <button type="submit"
                  class="submit w-full flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
                  Sign in
                </button>
              </div>
              <p class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">

              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</html>
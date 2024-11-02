<?php


if (isset($_SESSION['login_error'])) {
    echo "
    <div id='error-message' class='alert alert-danger flex align-items-center' role='alert' style='margin-top: 20px; margin-right: 20px; position: absolute; top: 0; right: 0; width: 300px; padding: 15px; color: black; background-color: #FF6868; border: 1px solid #DCFFB7; border-radius: 4px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-size: 16px;'>
      <svg class='bi flex-shrink-0 me-2' role='img' aria-label='Error:' style='width: 24px; height: 24px;'><use xlink:href='#exclamation-triangle-fill'/></svg>
      <div>
        {$_SESSION['login_error']}
      </div>
      <div class='spinner-border text-danger ms-auto' role='status' style='width: 1rem; height: 1rem;'>
        <span class='visually-hidden'>Loading...</span>
      </div>
    </div>";
    // unset the session variable so it doesn't keep showing up
    unset($_SESSION['login_error']);
}


?>
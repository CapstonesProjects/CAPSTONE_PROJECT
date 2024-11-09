document.getElementById('loginForm').addEventListener('submit', function() {
    event.preventDefault();
    document.getElementById('loadingScreen').style.display = 'flex';

    setTimeout(function() {
      document.getElementById('loginForm').submit();
    }, 3000);
  });
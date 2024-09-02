console.log('sessionmessage.js loaded');

window.addEventListener('load', function() {
    console.log('script loaded');
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000); // Hide the alert after 3 seconds
    });
});
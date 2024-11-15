document.addEventListener('DOMContentLoaded', function() {
    // Set the current date for the Filed Date input
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('fileddate').value = today;
});
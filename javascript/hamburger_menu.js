document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navLists = document.querySelectorAll('.navlist');

    menuToggle.addEventListener('click', function() {
        navLists.forEach(navList => navList.classList.toggle('show'));
        menuToggle.classList.toggle('active');
    });
});
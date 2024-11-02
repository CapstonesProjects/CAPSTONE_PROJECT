document.addEventListener('DOMContentLoaded', function() {
    // Save the current section in local storage
    const navLinks = document.querySelectorAll('.nav-linkss');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            const section = this.getAttribute('data-section');
            localStorage.setItem('currentSection', section);
        });
    });

    // Retrieve the current section from local storage and display it
    const currentSection = localStorage.getItem('currentSection');
    console.log('Current section from local storage:', currentSection);
    if (currentSection) {
        document.querySelectorAll('.sections').forEach(section => {
            // sectionsss.style.display = 'none';
        });
        const sectionElement = document.getElementById(currentSection);
        if (sectionElement) {
            sectionElement.style.display = 'block';
        } else {
            // console.error('Section element not found:', currentSection);
        }

        // Update the active nav link
        // navLinks.forEach(link => {
        //     link.classList.remove('active');
        //     if (link.getAttribute('data-section') === currentSection) {
        //         link.classList.add('active');
        //     }
        // });
    } else {
        // Default to showing the inbox section if no section is stored
        document.querySelectorAll('.section').forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById('inbox-content').style.display = 'block';
        document.getElementById('inbox-link').classList.add('active');
    }
});
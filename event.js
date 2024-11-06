document.addEventListener('DOMContentLoaded', function() {
    // Carousel next and previous functionality
    let next = document.querySelector('.next');
    let prev = document.querySelector('.prev');

    next.addEventListener('click', function() {
        let items = document.querySelectorAll('.item');
        document.querySelector('.slide').appendChild(items[0]);
    });

    prev.addEventListener('click', function() {
        let items = document.querySelectorAll('.item');
        document.querySelector('.slide').prepend(items[items.length - 1]);
    });

    // "See More" button functionality
    const buttons = document.querySelectorAll('.see-more');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Use closest() and querySelector() to ensure the correct description is found
            const description = button.closest('.content').querySelector('.des');

            // Debugging: Check if the description is selected properly
            console.log(description); // Log the description element

            // Toggle description visibility
            if (description.style.display === "none" || description.style.display === "") {
                description.style.display = "block";
                button.innerText = "See Less";  // Change button text
            } else {
                description.style.display = "none";
                button.innerText = "See More";  // Revert button text
            }
        });
    });
});
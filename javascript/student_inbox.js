document.addEventListener('DOMContentLoaded', function() {
    const messageContainers = document.querySelectorAll('.message-container');
    const messageDetails = document.getElementById('message-details');
    const detailsReceiver = document.getElementById('details-receiver');
    const detailsSubject = document.getElementById('details-subject');
    const detailsBody = document.getElementById('details-body');
    const closeDetails = document.getElementById('close-details');

    messageContainers.forEach(container => {
        container.addEventListener('click', function() {
            const receiver = this.querySelector('.w-72').textContent;
            const subject = this.querySelector('.w-48').textContent;
            const body = this.querySelector('.w-64').textContent;

            // Populate the details section with the message content
            detailsReceiver.textContent = receiver;
            detailsSubject.textContent = subject;
            detailsBody.textContent = body;

            // Hide all message containers
            messageContainers.forEach(c => c.style.display = 'none');

            // Show the details section
            messageDetails.style.display = 'block';
        });
    });

    closeDetails.addEventListener('click', function() {
        // Hide the details section
        messageDetails.style.display = 'none';

        // Show all message containers
        messageContainers.forEach(c => c.style.display = 'flex');
    });
});
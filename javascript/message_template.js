function insertTemplate() {
    const template = `
        Dear [Recipient Name],

        I hope this message finds you well. I am writing to inform you about [Subject].

        [Body of the letter]

        Best regards,
        [Your Name]
    `;
    document.getElementById('body').value = template;
}

document.addEventListener('DOMContentLoaded', function() {
    const composeButton = document.getElementById('composeButton');
    const composeWindow = document.getElementById('composeWindow');
    const closeCompose = document.getElementById('closeCompose');

    composeButton.addEventListener('click', function(event) {
        event.preventDefault();
        composeWindow.classList.remove('hidden');
    });

    closeCompose.addEventListener('click', function() {
        composeWindow.classList.add('hidden');
    });
});
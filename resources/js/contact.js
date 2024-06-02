
document.addEventListener("DOMContentLoaded", loadContactFormData);

function saveContactFormData() {
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;
    localStorage.setItem('contactFormData', JSON.stringify({ subject, message }));
}

function loadContactFormData() {
    const formData = JSON.parse(localStorage.getItem('contactFormData'));
    if (formData) {
        document.getElementById('subject').value = formData.subject;
        document.getElementById('message').value = formData.message;
    }
}

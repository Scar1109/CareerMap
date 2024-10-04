// Open the Edit Application popup
function openEditPopup(applicationId) {
    // Show the popup
    document.getElementById('edit-popup').style.display = 'flex';

    // Fetch application details via AJAX and populate the form
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'getApplicationDetails.php?id=' + applicationId, true);
    xhr.onload = function() {
        if (this.status === 200) {
            const application = JSON.parse(this.responseText);
            document.getElementById('application-id').value = application.id;
            document.getElementById('name').value = application.name;
            document.getElementById('email').value = application.email;
        }
    };
    xhr.send();
}

// Close the Edit Application popup
function closePopup() {
    document.getElementById('edit-popup').style.display = 'none';
}

// Confirm deletion of application
function confirmDelete(applicationId) {
    if (confirm('Are you sure you want to cancel this application?')) {
        window.location.href = 'deleteApplication.php?id=' + applicationId;
    }
}

// Handle Edit Application form submission
document.getElementById('edit-application-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'updateApplication.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            alert('Application updated successfully');
            window.location.reload(); // Refresh the page
        } else {
            alert('Error updating application');
        }
    };
    xhr.send(formData);
});

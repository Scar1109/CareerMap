//Create developer form validation
document.getElementById("developerForm-234").addEventListener("submit", function (event) {
    var fullname = document.getElementById("fullname-234").value;
    if (fullname === "") {
        alert("Full name is required!");
        event.preventDefault(); // Prevent the form from submitting
    }

    var skills = document.getElementById("skills-234").value;
    if (skills === "") {
        alert("Please enter your skills.");
        event.preventDefault();
    }
});

//View My Developer profile 

// JavaScript for enabling and disabling fields
const editButton = document.getElementById('edit-profile-btn-456');
const saveButton = document.getElementById('save-changes-btn-456');
const cancelButton = document.getElementById('cancel-edit-btn-456');
const inputs = document.querySelectorAll('.input-field-456');
const textareas = document.querySelectorAll('.textarea-field-456');

// Enable editing mode
editButton.addEventListener('click', function() {
    inputs.forEach(input => input.disabled = false); // Enable input fields
    textareas.forEach(textarea => textarea.disabled = false); // Enable textareas
    editButton.style.display = 'none'; // Hide Edit button
    saveButton.style.display = 'inline-block'; // Show Save button
    cancelButton.style.display = 'inline-block'; // Show Cancel button
});

// Cancel editing
cancelButton.addEventListener('click', function() {
    inputs.forEach(input => input.disabled = true); // Disable input fields
    textareas.forEach(textarea => textarea.disabled = true); // Disable textareas
    editButton.style.display = 'inline-block'; // Show Edit button
    saveButton.style.display = 'none'; // Hide Save button
    cancelButton.style.display = 'none'; // Hide Cancel button
});

// Save changes
saveButton.addEventListener('click', function() {
    if (confirm("Are you sure you want to save changes?")) {
        // Perform AJAX request to update the developer profile
        const fullname = document.getElementById('fullname-456').value;
        const bio = document.getElementById('bio-456').value;
        const skills = document.getElementById('skills-456').value;
        const pay = document.getElementById('pay-456').value;
        const github_link = document.getElementById('github_link-456').value;
        const linkedin_link = document.getElementById('linkedin_link-456').value;
        const behance_link = document.getElementById('behance_link-456').value;
        const stackoverflow_link = document.getElementById('stackoverflow_link-456').value;
        const portfolio_link = document.getElementById('portfolio_link-456').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/updateDeveloper.inc.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Profile updated successfully!');
                location.reload(); // Reload the page after successful update
            } else {
                alert('Error updating profile.');
            }
        };
        xhr.send('fullname=' + fullname + '&bio=' + bio + '&skills=' + skills + '&pay=' + pay + '&github_link=' + github_link + '&linkedin_link=' + linkedin_link + '&behance_link=' + behance_link + '&stackoverflow_link=' + stackoverflow_link + '&portfolio_link=' + portfolio_link);
    }
});

// Delete profile with confirmation
function confirmDelete(developerId) {
    if (confirm("Are you sure you want to delete your developer profile? This action cannot be undone.")) {
        window.location.href = 'includes/deleteDeveloper.inc.php?id=' + developerId;
    }
}

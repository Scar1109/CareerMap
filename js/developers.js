
// Email validation function using regex
function isValidEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// Event listener for form submission
document.getElementById('submit-btn-234').addEventListener('click', function(event) {
    const emailInput = document.getElementById('email-234').value;

    if (!isValidEmail(emailInput)) {
        alert('Please enter a valid email address.');
    }
})

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

// Enable Edit Mode with Confirmation
function enableEdit() {
    if (confirm("Do you want to enable editing?")) {
        const inputs = document.querySelectorAll('.input-field-456');
        const textareas = document.querySelectorAll('.textarea-field-456');
        
        // Enable all input fields and textareas
        inputs.forEach(input => {
            input.disabled = false; 
            input.classList.add('editable'); 
        });
        
        textareas.forEach(textarea => {
            textarea.disabled = false;
            textarea.classList.add('editable');
        });

        // Hide Edit button and Delete button
        document.getElementById('edit-profile-btn-456').style.display = 'none'; 
        document.getElementById('delete-profile-btn-456').style.display = 'none'; 

        // Show Save and Cancel buttons
        document.getElementById('save-changes-btn-456').style.display = 'inline-block'; 
        document.getElementById('cancel-edit-btn-456').style.display = 'inline-block'; 
    }
}

// Cancel Editing
function cancelEdit() {
    const inputs = document.querySelectorAll('.input-field-456');
    const textareas = document.querySelectorAll('.textarea-field-456');

    // Disable all input fields and textareas
    inputs.forEach(input => {
        input.disabled = true; 
        input.classList.remove('editable'); 
    });
    
    textareas.forEach(textarea => {
        textarea.disabled = true; 
        textarea.classList.remove('editable');
    });

    // Show Edit button and Delete button
    document.getElementById('edit-profile-btn-456').style.display = 'inline-block'; 
    document.getElementById('delete-profile-btn-456').style.display = 'inline-block'; 

    // Hide Save and Cancel buttons
    document.getElementById('save-changes-btn-456').style.display = 'none'; 
    document.getElementById('cancel-edit-btn-456').style.display = 'none'; 
}

// Save Changes Function 
function saveChanges() {
    if (confirm("Are you sure you want to save changes?")) {
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

        // Construct the form data string correctly
        const data = `fullname=${encodeURIComponent(fullname)}&bio=${encodeURIComponent(bio)}&skills=${encodeURIComponent(skills)}&pay=${encodeURIComponent(pay)}&github_link=${encodeURIComponent(github_link)}&linkedin_link=${encodeURIComponent(linkedin_link)}&behance_link=${encodeURIComponent(behance_link)}&stackoverflow_link=${encodeURIComponent(stackoverflow_link)}&portfolio_link=${encodeURIComponent(portfolio_link)}`;

        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText); // Display success message from the server
                location.reload(); // Reload the page after successful update
            } else {
                alert('Error updating profile.');
            }
        };
        xhr.send(data); // Send the constructed form data
    }
}



// Delete profile with confirmation
function confirmDelete(developerId) {
    if (confirm("Are you sure you want to delete your developer profile? This action cannot be undone.")) {
        window.location.href = 'includes/deleteDeveloper.inc.php?id=' + developerId;
    }
}

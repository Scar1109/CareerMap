document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.CP_form');
    
    form.addEventListener('submit', function (event) {
        const companyName = document.getElementById('CP_company_name').value.trim();
        const about = document.getElementById('CP_company_about').value.trim();
        const description = document.getElementById('CP_description').value.trim();
        const website = document.getElementById('CP_website').value.trim();
        const location = document.getElementById('CP_location').value.trim();
        const employees = document.getElementById('CP_employees').value.trim();

        // Regular expression for website URL validation
        const urlPattern = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]+(\/[\w\-._~:/?#[\]@!$&'()*+,;=.]+)?$/;
        
        // Regular expression for name validation (letters and spaces only)
        const namePattern = /^[A-Za-z\s]+$/;

        // Validation for company name (letters and spaces only)
        if (!namePattern.test(companyName)) {
            alert("Company name should only contain letters and spaces.");
            event.preventDefault();
        }
        // Validate that the description has at least 20 characters
        else if (description.length < 20) {
            alert("Description must be at least 20 characters long.");
            event.preventDefault();
        }
        // Ensure that the website is a valid URL
        else if (!urlPattern.test(website)) {
            alert("Please enter a valid website URL.");
            event.preventDefault();
        }
        // Ensure that the number of employees is a positive integer
        else if (!/^\d+$/.test(employees) || parseInt(employees) <= 0) {
            alert("Number of employees must be a positive number.");
            event.preventDefault();
        }
        // Ensure that all fields are filled
        else if (!companyName || !about || !description || !website || !location) {
            alert("Please fill in all the required fields.");
            event.preventDefault();
        }
    });
});

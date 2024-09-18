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

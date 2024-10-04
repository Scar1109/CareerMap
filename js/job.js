 // Description: JavaScript for the create job page.
 // Check if 'success' is in the URL parameters
 const urlParams = new URLSearchParams(window.location.search);
 if (urlParams.has('success') && urlParams.get('success') === '1') {
     const successMessage = document.getElementById('successMessage');
     successMessage.style.display = 'block';
 }


 // Description: JavaScript for the view job page.
 // Helper function for time ago format using JavaScript
function timeElapsedString(datetime) {
    const now = new Date();
    const past = new Date(datetime);
    const diffInSeconds = Math.floor((now - past) / 1000);

    const timeIntervals = {
        year: 31536000,  // 60 * 60 * 24 * 365
        month: 2592000,  // 60 * 60 * 24 * 30
        day: 86400,      // 60 * 60 * 24
        hour: 3600,      // 60 * 60
        minute: 60,
        second: 1
    };

    let timeAgo = '';

    for (const [key, seconds] of Object.entries(timeIntervals)) {
        const time = Math.floor(diffInSeconds / seconds);
        if (time >= 1) {
            timeAgo = `${time} ${key}${time > 1 ? 's' : ''} ago`;
            break;
        }
    }

    return timeAgo || 'just now';
}

// Use the JavaScript timeElapsedString function
document.addEventListener('DOMContentLoaded', function () {
    const postedTimeElement = document.querySelector('.JB_posted-time');
    const postedTime = postedTimeElement.getAttribute('data-datetime');

    // Call the timeElapsedString function
    const timeAgo = timeElapsedString(postedTime);

    // Update the content of the element
    postedTimeElement.textContent = `Posted ${timeAgo}`;
});
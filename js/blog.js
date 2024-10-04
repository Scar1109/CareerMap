const cardsPerPage = 6; // Number of cards per page
let currentPage = 1;
const gridContainer = document.getElementById('blogGrid');
const cards = document.querySelectorAll('.blog_card_005');
const totalCards = cards.length;
const totalPages = Math.ceil(totalCards / cardsPerPage);
const prevButton = document.getElementById('prevPage');
const nextButton = document.getElementById('nextPage');
const paginationInfo = document.getElementById('paginationInfo');

// Function to display the cards for the current page
function showPage(page) {
    const startIndex = (page - 1) * cardsPerPage;
    const endIndex = startIndex + cardsPerPage;

    // Hide all cards
    cards.forEach((card, index) => {
        if (index >= startIndex && index < endIndex) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    // Update pagination info
    paginationInfo.textContent = `Page ${currentPage} of ${totalPages}`;

    // Enable/Disable buttons based on the current page
    prevButton.disabled = page === 1;
    nextButton.disabled = page === totalPages;
}

// Event listeners for pagination buttons
prevButton.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
    }
});

nextButton.addEventListener('click', () => {
    if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
    }
});

// Initialize the first page
showPage(currentPage);


// Image Privew 


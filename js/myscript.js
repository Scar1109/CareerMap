//slide show
let slideIndex = 1;
let slideshowTimer;

showSlides(slideIndex);
startSlideshow();

function currentSlide(n) {
    clearTimeout(slideshowTimer);
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    
    startSlideshow();
}

function startSlideshow() {
    clearTimeout(slideshowTimer);
    slideshowTimer = setTimeout(() => {
        slideIndex++;
        showSlides(slideIndex);
    }, 5000);
}

const leftBtn = document.querySelector('.carousel_btn_left_003');
const rightBtn = document.querySelector('.carousel_btn_right_007');
const carouselItems = document.querySelector('.carousel_items_004');

let currentScrollPosition = 0;
const scrollAmount = 270; // Width of one item including margin

const totalItems = document.querySelectorAll('.carousel_item_005').length;
const visibleItems = 4; // Number of visible items
const maxScrollPosition = (totalItems - visibleItems) * scrollAmount;

function updateCarouselPosition() {
    carouselItems.style.transform = `translateX(-${currentScrollPosition}px)`;
}

leftBtn.addEventListener('click', () => {
    if (currentScrollPosition > 0) {
        currentScrollPosition -= scrollAmount;
        updateCarouselPosition();
    }
});

rightBtn.addEventListener('click', () => {
    if (currentScrollPosition < maxScrollPosition) {
        currentScrollPosition += scrollAmount;
        updateCarouselPosition();
    }
});
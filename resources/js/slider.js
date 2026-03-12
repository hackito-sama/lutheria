const slides = document.querySelectorAll('.slide');
let current = 0;
let intervalTime = 3000;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('opacity-100', i === index);
        slide.classList.toggle('opacity-0', i !== index);
    });
}

document.getElementById('next').addEventListener('click', () => {
    current = (current + 1) % slides.length;
    showSlide(current);
    resetInterval();
});

document.getElementById('prev').addEventListener('click', () => {
    current = (current - 1 + slides.length) % slides.length;
    showSlide(current);
    resetInterval();
});

let slideInterval = setInterval(() => {
    current = (current + 1) % slides.length;
    showSlide(current);
}, intervalTime);

function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(() => {
        current = (current + 1) % slides.length;
        showSlide(current);
    }, intervalTime);
}

showSlide(current);
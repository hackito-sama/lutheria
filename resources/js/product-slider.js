// product-slider.js

// 1. Pasamos los productos desde Blade a JS
const products = window.productsData; // ahora lo pasaremos desde Blade al cargar la página

const sliderContainer = document.getElementById('slider');
let slides = [];
let currentSlide = 0;

// 2. Función para calcular cuántos productos por slide según pantalla
function getProductsPerSlide() {
    const width = window.innerWidth;
    if (width >= 1024) return 4; // desktop
    if (width >= 768) return 2;  // tablet
    return 1;                   // móvil
}

// 3. Función para generar slides dinámicamente
function generateSlides() {
    sliderContainer.innerHTML = ''; // limpiar
    const perSlide = getProductsPerSlide();
    slides = [];

    for (let i = 0; i < products.length; i += perSlide) {
        const chunk = products.slice(i, i + perSlide);
        const slide = document.createElement('div');
        slide.className = 'product-slide absolute top-0 left-0 w-full transition-opacity duration-700 opacity-0';

        const grid = document.createElement('div');
        grid.className = `grid grid-cols-1 ${perSlide > 1 ? 'sm:grid-cols-2' : ''} ${perSlide === 4 ? 'lg:grid-cols-4' : ''} gap-6`;

        chunk.forEach(product => {
            const card = document.createElement('div');
            card.className = 'flex flex-col justify-between items-center bg-white shadow-md rounded-2xl p-6 h-full';

            card.innerHTML = `
                <img src="${product.image}" alt="${product.name}" class="w-40 h-40 object-contain rounded-lg mb-4 bg-gray-100">
                <a href="/products/${product.id}" class="text-lg font-semibold mb-2 text-center text-luth-blue hover:underline">${product.name}</a>
                <p class="text-xl font-bold text-green-600 mb-4">$${parseFloat(product.price).toFixed(0)}</p>
                <button 
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition w-full"
                    data-id="${product.id}"
                    data-name="${product.name}"
                    data-price="${product.price}"
                    data-image="${product.image}"
                    data-stock="${product.stock}"
                >
                    Consultar por WhatsApp
                </button>
            `;

            const btn = card.querySelector("button");
            btn.addEventListener("click", () => {
                sendWhatsAppMessage(product); // 👈 ahora sí funciona
            });

            grid.appendChild(card);
        });

        slide.appendChild(grid);
        sliderContainer.appendChild(slide);
        slides.push(slide);
    }

    currentSlide = 0;
    showSlide(currentSlide);
}


// 4. Función para mostrar slide
function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('opacity-100');
        slide.classList.add('opacity-0');
        if (i === index) slide.classList.remove('opacity-0'), slide.classList.add('opacity-100');
    });
}

function sendWhatsAppMessage(product) {
    console.log(WHATSAPP_PHONE);
    const phone = WHATSAPP_PHONE; // tu número en formato internacional
    const message = `Hola, quiero consultar por el producto:\n${product.name}\nPrecio: $${product.price}`;
    const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
    window.open(url, "_blank");
}

// 5. Botones
document.getElementById('nextProduct').addEventListener('click', () => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
});
document.getElementById('prevProduct').addEventListener('click', () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
});

// 6. Autoplay
setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}, 5000);

// 7. Regenerar slides al redimensionar pantalla
window.addEventListener('resize', generateSlides);

// 8. Inicializar slider
generateSlides();
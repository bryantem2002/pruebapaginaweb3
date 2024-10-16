const vehicles = [
    { id: 1, image: 'img/noticias3.png', link: 'noticia1.1.html' },
    { id: 2, image: 'img/NOTICIAS-10.png', link: 'noticia2.html' },
    { id: 3, image: 'img/NOTICIAS-26.png', link: 'noticia3.html' },
    { id: 4, image: 'img/noticias4.png', link: 'noticia4.html' },
    { id: 5, image: 'img/noticias5.png', link: 'noticia5.html' },
];

const carousel = document.getElementById('carousel');
let currentIndex = 0;

const renderSlides = () => {
    carousel.innerHTML = vehicles.map(vehicle => `
        <div class="relative mr-8 flex-shrink-0 w-[300px] h-[200px]">
            <a href="${vehicle.link}"> <!-- Wrap the image in an anchor tag -->
                <img src="${vehicle.image}" alt="" class="w-full h-full object-cover rounded-lg shadow-md transition-transform duration-300 hover:scale-[1.05]">
            </a>
            <button class="absolute bottom-[10px] right-[10px] bg-sky-700 text-white rounded-full w-[40px] h-[40px] flex items-center justify-center shadow-md hover:bg-sky-800 transition duration-300">+</button>
        </div>
    `).join('');
    updateCarousel();
};

const updateCarousel = () => {
    const translateX = -currentIndex * (100 / vehicles.length);
    carousel.style.transform = `translateX(${translateX}%)`;
};

const nextSlide = () => {
    currentIndex = (currentIndex + 1) % vehicles.length;
    updateCarousel();
};

const prevSlide = () => {
    currentIndex = (currentIndex - 1 + vehicles.length) % vehicles.length;
    updateCarousel();
};

document.getElementById('nextBtn').addEventListener('click', nextSlide);
document.getElementById('prevBtn').addEventListener('click', prevSlide);

renderSlides();
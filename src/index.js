document.addEventListener('DOMContentLoaded', () =>{
    const carouselElements = document.querySelectorAll('.carousel');
    M.Carousel.init(carouselElements, {
        duration: 50,
        dist: -40,
        shift: 5,
        padding: 5,
        numVisible: 5,
        indicators: true,
        noWrap: false
    });
});


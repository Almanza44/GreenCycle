// ============================================
// GREEN CYCLE
// SLIDER "¿CÓMO FUNCIONA?"
// ============================================

const slider = document.querySelector(".slider");

if (slider) {


const track = slider.querySelector(".slider__track");
const slides = slider.querySelectorAll(".slide");

const previousButton = slider.querySelector(".slider__button--prev");
const nextButton = slider.querySelector(".slider__button--next");

const dots = document.querySelectorAll(".slider__dot");

let currentSlide = 0;


// ============================================
// CAMBIAR SLIDE
// ============================================

function showSlide(index) {

    // Volver al último slide si retrocedemos desde el primero
    if (index < 0) {
        currentSlide = slides.length - 1;
    }

    // Volver al primero si avanzamos desde el último
    else if (index >= slides.length) {
        currentSlide = 0;
    }

    else {
        currentSlide = index;
    }


    // Mover el contenido
    track.style.transform = `translateX(-${currentSlide * 100}%)`;


    // Actualizar indicadores
    dots.forEach((dot, dotIndex) => {

        const isActive = dotIndex === currentSlide;

        dot.classList.toggle("is-active", isActive);

        dot.setAttribute(
            "aria-current",
            isActive ? "true" : "false"
        );

    });

}


// ============================================
// BOTÓN ANTERIOR
// ============================================

previousButton.addEventListener("click", () => {

    showSlide(currentSlide - 1);

});


// ============================================
// BOTÓN SIGUIENTE
// ============================================

nextButton.addEventListener("click", () => {

    showSlide(currentSlide + 1);

});


// ============================================
// INDICADORES
// ============================================

dots.forEach((dot, index) => {

    dot.addEventListener("click", () => {

        showSlide(index);

    });

});


// ============================================
// INICIALIZAR SLIDER
// ============================================

showSlide(0);


}

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

document.querySelectorAll('.password-toggle').forEach((button) => {
    button.addEventListener('click', () => {
        const input = document.getElementById(button.dataset.target);

        if (input.type === 'password') {
            input.type = 'text';
            button.textContent = 'Ocultar';
            button.setAttribute('aria-label', 'Ocultar contraseña');
        } else {
            input.type = 'password';
            button.textContent = 'Mostrar';
            button.setAttribute('aria-label', 'Mostrar contraseña');
        }
    });
});

const plantModal = document.getElementById('plant-modal');
const openPlantModal = document.getElementById('open-plant-modal');
const openPlantModalEmpty = document.getElementById('open-plant-modal-empty');
const closePlantModal = document.getElementById('close-plant-modal');
const plantModalOverlay = document.querySelector('.plant-modal__overlay');

const openModal = () => {
    plantModal.classList.add('is-open');
    plantModal.setAttribute('aria-hidden', 'false');
};

const closeModal = () => {
    plantModal.classList.remove('is-open');
    plantModal.setAttribute('aria-hidden', 'true');
};

openPlantModal?.addEventListener('click', openModal);
openPlantModalEmpty?.addEventListener('click', openModal);
closePlantModal?.addEventListener('click', closeModal);
plantModalOverlay?.addEventListener('click', closeModal);

// ============================================
// LOGIN
// ============================================

const loginForm = document.getElementById('login-form');

loginForm?.addEventListener('submit', async (event) => {

    event.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {

        const response = await fetch('/api/login', {
            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                email: email,
                password: password
            })
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(
                data.message || 'No se pudo iniciar sesión.'
            );
        }

        localStorage.setItem('access_token', data.access_token);

        window.location.href = '/dashboard';

    } catch (error) {

        console.error('Error al iniciar sesión:', error);

        alert(error.message);
    }

});
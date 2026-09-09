<?php $__env->startSection('title', 'Inicio | ' . config('app.name')); ?>

<?php $__env->startSection('content'); ?>

    <!-- ============================================
         HERO
         ============================================ -->
    <section class="hero">
        <div class="hero__content">

            <p class="hero__eyebrow">
                TU VIVERO DIGITAL
            </p>

            <h1>
                Cuida tus árboles.<br>
                Haz crecer tu mundo.
            </h1>

            <p class="hero__description">
                Bienvenido a GreenCycle, un espacio donde puedes crear y cuidar
                tu propio vivero digital. Planta árboles, cuídalos y observa
                cómo crecen.
            </p>

            <div class="hero__actions">
                <a href="#" class="button button--primary">
                    Comenzar a cultivar
                </a>

                <a href="#" class="button button--secondary">
                    Iniciar sesión
                </a>
            </div>

        </div>

        <div class="hero__visual" aria-hidden="true">
            <img
                src="<?php echo e(asset('images/inicio.jpg')); ?>"
                alt="Ilustración de un árbol"
                class="hero__tree"
            >
        </div>
    </section>


    <!-- ============================================
         CÓMO FUNCIONA
         ============================================ -->
    <section class="features" aria-labelledby="features-title">


<div class="section-heading">
    <p class="section-heading__eyebrow">
        ¿CÓMO FUNCIONA?
    </p>

    <h2 id="features-title">
        Haz crecer tu vivero
    </h2>

    <p>
        Cada decisión cuenta. Cuida tus árboles y llévalos hasta su máximo crecimiento.
    </p>
</div>

<div class="slider" aria-label="Funciones de GreenCycle">

    <button
        class="slider__button slider__button--prev"
        type="button"
        aria-label="Ver función anterior"
    >
        ←
    </button>

    <div class="slider__viewport">

        <div class="slider__track">

            <article class="slide">
                <div class="slide__content">
                    <p class="slide__number">01</p>

                    <h3>
                        Planta
                    </h3>

                    <p>
                        Crea nuevos árboles y comienza a construir
                        tu propio vivero digital.
                    </p>
                </div>

                <div class="slide__image">
                    <img
                        src="<?php echo e(asset('images/plantar.jpg')); ?>"
                        alt="Ilustración de un árbol siendo plantado"
                    >
                </div>
            </article>


            <article class="slide">
                <div class="slide__content">
                    <p class="slide__number">02</p>

                    <h3>
                        Cuida
                    </h3>

                    <p>
                        Cuida tus árboles para mantener su salud
                        y ayudarlos a alcanzar nuevos niveles.
                    </p>
                </div>

                <div class="slide__image">
                    <img
                        src="<?php echo e(asset('images/cuidar.jpg')); ?>"
                        alt="Ilustración de una persona cuidando un árbol"
                    >
                </div>
            </article>


            <article class="slide">
                <div class="slide__content">
                    <p class="slide__number">03</p>

                    <h3>
                        Cosecha
                    </h3>

                    <p>
                        Lleva tus árboles hasta la madurez y obtén
                        Green Coins para mejorar tu vivero.
                    </p>
                </div>

                <div class="slide__image">
                    <img
                        src="<?php echo e(asset('images/cosechar.jpg')); ?>"
                        alt="Ilustración de un árbol listo para ser cosechado"
                    >
                </div>
            </article>

        </div>

    </div>

    <button
        class="slider__button slider__button--next"
        type="button"
        aria-label="Ver siguiente función"
    >
        →
    </button>

</div>

<div class="slider__dots" aria-label="Seleccionar función">

    <button
        class="slider__dot is-active"
        type="button"
        aria-label="Ver Planta"
        aria-current="true"
    ></button>

    <button
        class="slider__dot"
        type="button"
        aria-label="Ver Cuida"
        aria-current="false"
    ></button>

    <button
        class="slider__dot"
        type="button"
        aria-label="Ver Cosecha"
        aria-current="false"
    ></button>

</div>


</section>



    <!-- ============================================
         CTA
         ============================================ -->
    <section class="cta">

        <h2>
            ¿Listo para empezar?
        </h2>

        <p>
            Crea tu cuenta y comienza a construir tu vivero.
        </p>

        <a href="#" class="button button--primary">
            Crear mi cuenta
        </a>

    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dpame\GreenCycle\resources\views/home.blade.php ENDPATH**/ ?>
<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proyecto base del curso de desarrollo web con Laravel.">

    <title>
        <?php echo $__env->yieldContent('title', config('app.name')); ?>
    </title>

    <?php echo app('Illuminate\Foundation\Vite')([
        'resources/css/app.css',
        'resources/js/app.js',
    ]); ?>
</head>

<body>
    <!-- ============================================
         HEADER
         ============================================ -->
    <header class="site-header">
        <div class="site-header__content">
            <a class="brand" href="<?php echo e(route('home')); ?>">
                GreenCycle
            </a>

            <span class="environment">
                Ambiente: <?php echo e(app()->environment()); ?>

            </span>
        </div>
    </header>

    <!-- ============================================
         CONTENIDO PRINCIPAL
         ============================================ -->
    <main class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- ============================================
         FOOTER
         ============================================ -->
    <footer class="site-footer">
        <div class="site-footer__content">
            <span>TM4100 - Desarrollo de Aplicaciones Interactivas I</span>
            <span>Laravel <?php echo e(app()->version()); ?></span>
        </div>
    </footer>
</body>
</html><?php /**PATH C:\Users\dpame\GreenCycle\resources\views/layouts/app.blade.php ENDPATH**/ ?>
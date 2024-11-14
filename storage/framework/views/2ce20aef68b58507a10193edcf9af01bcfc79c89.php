<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="<?php echo e(config('app.name', 'Laravel')); ?>">
    <meta name="keywords" content="Laravel, <?php echo e(config('app.name', 'Laravel')); ?>">
    <meta name="author" content="Your Name">

    <title><?php echo e(__('AnimeHub')); ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM0xiPJaC6lJ9gxw4Y6AGe8tH7/f5Bkx0PSly34" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

</head>
<body class="font-sans antialiased bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-gray-800">
    <div class="min-h-screen flex flex-col">

        <!-- Navigation -->
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Page Heading -->
        <header class="bg-white shadow-lg p-4 sm:p-6 lg:p-8">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-semibold text-gray-800"><?php echo e($header); ?></h1>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 bg-gray-50 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <?php echo e($slot); ?>

            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6">
            <div class="text-center">
                <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(__('AnimeHub')); ?>. All rights reserved.</p>
            </div>
        </footer>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\Practice02\resources\views/layouts/app.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'EcoTech - Tecnología Sustentable'); ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background-color: #1b4332 !important;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #d8f3dc !important;
        }
        .navbar-custom .nav-link:hover {
            color: #ffffff !important;
        }
        .btn-success-custom {
            background-color: #2d6a4f;
            border-color: #2d6a4f;
        }
        .btn-success-custom:hover {
            background-color: #1b4332;
            border-color: #1b4332;
        }
        .hero-section {
            background: linear-gradient(135deg, #1b4332, #2d6a4f);
            color: white;
            padding: 80px 0;
        }
        .product-card, .post-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            height: 100%;
        }
        .product-card:hover, .post-card:hover {
            transform: translateY(-5px);
        }
        .text-success-custom {
            color: #2d6a4f !important;
        }
        footer {
            background-color: #1b4332;
            color: white;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('home')); ?>">
                <i class="bi bi-tree"></i> EcoTech
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('blog.index')); ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('products.index')); ?>">Productos</a>
                    </li>
	    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('services.index')); ?>">
            <i class="bi bi-wifi"></i> Servicios
        </a>
    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?php echo e(Auth::user()->name ?? 'Usuario'); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>"><i class="bi bi-gear"></i> Perfil</a></li>
                                <?php if(Auth::user() && Auth::user()->isAdmin()): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-shield-lock"></i> Panel Admin</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="bi bi-person-plus"></i> Registrarse</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; <?php echo e(date('Y')); ?> EcoTech - Tecnología Sustentable</p>
            <small class="text-light-emphasis">Construyendo un futuro más verde</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\ecotech2\resources\views/layouts/app.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Panel Admin - EcoTech'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #1b4332;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: #d8f3dc;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar .active {
            background: #2d6a4f;
            color: white;
        }
        .content-area {
            padding: 20px;
            background: #f8f9fa;
            min-height: 100vh;
        }
        .header-admin {
            background: #2d6a4f;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <h4 class="mb-4"><i class="bi bi-shield-lock"></i> Panel Admin</h4>
                <hr class="bg-light">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="bi bi-house"></i> Dashboard
                </a>
                <a href="<?php echo e(route('admin.blog.index')); ?>" class="<?php echo e(request()->routeIs('admin.blog.*') ? 'active' : ''); ?>">
                    <i class="bi bi-newspaper"></i> Blog
                </a>
                <a href="<?php echo e(route('admin.users')); ?>" class="<?php echo e(request()->routeIs('admin.users*') ? 'active' : ''); ?>">
                    <i class="bi bi-people"></i> Usuarios
                </a>
                <hr class="bg-light">
                <a href="<?php echo e(url('/')); ?>" target="_blank">
                    <i class="bi bi-eye"></i> Ver sitio
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-3">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </button>
                </form>
            </div>

            <!-- Contenido -->
            <div class="col-md-10 content-area">
                <div class="header-admin d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-person"></i> <?php echo e(Auth::user()->name ?? 'Admin'); ?>

                        </span>
                        <span class="badge bg-warning text-dark ms-2">
                            <i class="bi bi-shield"></i> Administrador
                        </span>
                    </div>
                </div>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\ecotech\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>
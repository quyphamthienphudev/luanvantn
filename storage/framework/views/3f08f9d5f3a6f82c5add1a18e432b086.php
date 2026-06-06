<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- script biểu đồ  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue-800 text-white flex flex-col">

        <div class="p-6 text-2xl font-bold border-b border-blue-700">
            HỆ THỐNG QUẢN LÝ NHÂN SỰ
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="/" class="block px-4 py-2 rounded hover:bg-blue-700">
                Trang chủ
            </a>

            <?php if(auth()->user()->role->name === 'admin'): ?>
            <a href="/admin/employees" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý nhân viên
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->role->name === 'user'): ?>
            <a href="/employees" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý nhân viên
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->role->name === 'admin'): ?>
            <a href="/admin/departments" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý phòng ban
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->role->name === 'user'): ?>
            <a href="/departments" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý phòng ban
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->role->name === 'admin'): ?>
            <a href="/admin/positions" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý chức vụ
            </a>
            <?php endif; ?>
            
            <?php if(auth()->user()->role->name === 'user'): ?>
            <a href="/positions" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý chức vụ
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->role->name === 'admin'): ?>
            <a href="/admin/candidates" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý hồ sơ ứng viên
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->role->name === 'user'): ?>
            <a href="/candidates" class="block px-4 py-2 rounded hover:bg-blue-700">
                Quản lý hồ sơ ứng viên
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->role->name === 'admin'): ?>
            <a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-blue-700">
                Báo cáo thống kê
            </a>
            <?php endif; ?>
            
            <?php if(auth()->user()->role->name === 'admin'): ?>
                <a href="/admin/accounts" class="block px-4 py-2 rounded hover:bg-blue-700">
                    Quản lý tài khoản
                </a>
            <?php endif; ?>

            <a href="/profile" class="block px-4 py-2 rounded hover:bg-blue-700">
                Cập nhật thông tin
            </a>

            <a href="/change-password" class="block px-4 py-2 rounded hover:bg-blue-700">
                Đổi mật khẩu
            </a>

        </nav>

        <div class="p-4 border-t border-blue-700">
            <a href="/logout" class="block text-center bg-red-500 hover:bg-red-600 py-2 rounded">
                Đăng xuất
            </a>
        </div>

    </aside>

    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">
                <?php echo $__env->yieldContent('title'); ?>
            </h1>

            <div class="text-gray-600">
                Xin chào, <strong><?php echo e(auth()->user()->name); ?></strong>
            </div>
        </div>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

</div>

</body>
</html>
<?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/layouts/app.blade.php ENDPATH**/ ?>
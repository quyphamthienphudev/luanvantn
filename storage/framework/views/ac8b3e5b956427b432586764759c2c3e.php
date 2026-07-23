<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Script biểu đồ  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

</head>

<body class="bg-gray-100">

    <!-- Nút menu mobile -->
    <div class="md:hidden bg-blue-800 text-white p-4 flex items-center">
        <button onclick="toggleSidebar()" class="text-2xl mr-4" title="Menu">
            ☰
        </button>

        <span class="font-bold">
            HỆ THỐNG QUẢN LÝ NHÂN SỰ
        </span>
    </div>
    <div class="flex min-h-screen">

        <!-- SIDEBAR -->

        <aside id="sidebar" class="fixed md:static inset-y-0 left-0 z-50
           w-64 bg-blue-800 text-white flex flex-col
           transform -translate-x-full md:translate-x-0
           transition-transform duration-300">

            <div class="p-6 text-2xl font-bold border-b border-blue-700">
                HỆ THỐNG QUẢN LÝ NHÂN SỰ
            </div>

            <!-- Đóng menu -->
            <button onclick="toggleSidebar()" class="md:hidden absolute top-4 right-4 text-white text-2xl" title="Đóng Menu">
                ✕
            </button>

            <nav class="flex-1 p-4 space-y-2">

                <?php if(auth()->user()->role->name === 'admin'): ?>
                <a href="/admin/home" class="block px-4 py-2 rounded hover:bg-blue-700" title="Trang chủ">
                    Trang chủ
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/home" class="block px-4 py-2 rounded hover:bg-blue-700" title="Trang chủ">
                    Trang chủ
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'qlcl'): ?>
                <a href="/qlcl/home" class="block px-4 py-2 rounded hover:bg-blue-700" title="Trang chủ">
                    Trang chủ
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'httt'): ?>
                <a href="/httt/home" class="block px-4 py-2 rounded hover:bg-blue-700" title="Trang chủ">
                    Trang chủ
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'user'): ?>
                <a href="/home" class="block px-4 py-2 rounded hover:bg-blue-700" title="Trang chủ">
                    Trang chủ
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'admin'): ?>
                <a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-blue-700" title="Báo cáo thống kê">
                    Báo cáo thống kê
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/employees" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý nhân viên">
                    Quản lý nhân viên
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/contracts" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý hợp đồng lao động">
                    Quản lý hợp đồng lao động
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/departments" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý phòng ban">
                    Quản lý phòng ban
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/positions" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý công việc">
                    Quản lý công việc
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/candidates" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý hồ sơ ứng viên">
                    Quản lý hồ sơ ứng viên
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/payrolls" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý lương">
                    Quản lý lương
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/attendances" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý chấm công">
                    Quản lý chấm công
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/rewards" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý khen thưởng">
                    Quản lý khen thưởng
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/disciplines" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý kỷ luật">
                    Quản lý kỷ luật
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'hcns'): ?>
                <a href="/hcns/leave" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý nghỉ phép">
                    Quản lý nghỉ phép
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'qlcl'): ?>
                <a href="/qlcl/employees" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý nhân viên">
                    Quản lý nhân viên
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'qlcl'): ?>
                <a href="/qlcl/leave" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý nghỉ phép">
                    Quản lý nghỉ phép
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'qlcl'): ?>
                <a href="/qlcl/attendances" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý chấm công">
                    Quản lý chấm công
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'httt'): ?>
                <a href="/httt/accounts" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý tài khoản">
                    Quản lý tài khoản
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'httt'): ?>
                <a href="/httt/roles" class="block px-4 py-2 rounded hover:bg-blue-700" title="Quản lý quyền truy cập">
                    Quản lý quyền truy cập
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'user'): ?>
                <a href="/payrolls" class="block px-4 py-2 rounded hover:bg-blue-700" title="Xem lương">
                    Xem lương
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->role->name === 'user'): ?>
                <a href="/attendances" class="block px-4 py-2 rounded hover:bg-blue-700" title="Chấm công">
                    Chấm công
                </a>
                <?php endif; ?>
                
                <?php if(auth()->user()->role->name === 'user'): ?>
                <a href="/leave" class="block px-4 py-2 rounded hover:bg-blue-700" title="Đăng kí nghỉ phép">
                    Đăng kí nghỉ phép
                </a>
                <?php endif; ?>

                <a href="/profile" class="block px-4 py-2 rounded hover:bg-blue-700" title="Cập nhật thông tin">
                    Cập nhật thông tin
                </a>

                <a href="/change-password" class="block px-4 py-2 rounded hover:bg-blue-700" title="Đổi mật khẩu">
                    Đổi mật khẩu
                </a>

                <a href="/logout" class="block text-center bg-red-500 hover:bg-red-600 py-2 rounded" title="Đăng xuất">
                    Đăng xuất
                </a>

            </nav>

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

    <!-- javascript  menu -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>

</html><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/layouts/app.blade.php ENDPATH**/ ?>
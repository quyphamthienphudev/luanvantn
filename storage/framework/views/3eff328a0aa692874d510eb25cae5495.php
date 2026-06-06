<?php $__env->startSection('title', 'Thống kê'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Báo cáo thống kê</title>
</head>
<body>
    <div class="container mt-4">
        <div class="row g-4">
            <h1 class="text-2xl font-bold mb-6">
                Số lượng nhân viên
            </h1>
            <!-- EMPLOYEES -->
        <div class="grid grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng nhân viên tạo bởi Admin</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($e_admin); ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng nhân viên tạo bởi User</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($e_user); ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng nhân viên tất cả</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($employees); ?></p>
            </div>
            <!-- CONTENT -->
            <div class="flex-1 p-8">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        <br>
        <div class="row g-4">
            <h1 class="text-2xl font-bold mb-6">
                Số lượng phòng ban
            </h1>
            <!-- departments -->
        <div class="grid grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng phòng ban tạo bởi Admin</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($d_admin); ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng phòng ban tạo bởi User</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($d_user); ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Số lượng phòng ban tất cả</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($departments); ?></p>
            </div>
            <!-- CONTENT -->
            <div class="flex-1 p-8">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Số lượng nhân viên theo phòng ban
        </h1>
        <div class="bg-white p-6 rounded shadow w">
            <canvas id="departmentChart" height="120"></canvas>
        </div>
        <script>
            const ctxDept = document.getElementById('departmentChart').getContext('2d');
            const departmentChart = new Chart(ctxDept, {
                type: 'bar', // cột dọc
                data: {
                    labels: <?php echo json_encode($deptLabels); ?>,
                    datasets: [{
                    label: 'Số lượng nhân viên',
                    data: <?php echo json_encode($deptData); ?>,
                    borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Phòng ban'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Số lượng nhân viên'
                            },
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        </script>
        </div>
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
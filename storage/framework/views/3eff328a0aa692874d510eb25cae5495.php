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
                    <h3 class="text-gray-500">Số lượng nhân viên đang làm việc</h3>
                    <p class="text-3xl font-bold text-blue-600"><?php echo e($e_working); ?></p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500">Số lượng nhân viên đã nghỉ việc</h3>
                    <p class="text-3xl font-bold text-blue-600"><?php echo e($e_resign); ?></p>
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
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Tổng chi phí lương
        </h1>
        <form method="GET" action="<?php echo e(url('/admin/dashboard')); ?>" class="bg-white p-6 rounded shadow w-1/2">

            <?php echo csrf_field(); ?>
            <?php if(session('error_year')): ?>
            <p class="text-red-500 text-sm"><?php echo e(session('error_year')); ?></p>
            <?php endif; ?>
            <?php if(session('error_month')): ?>
            <p class="text-red-500 text-sm"><?php echo e(session('error_month')); ?></p>
            <?php endif; ?>

            <!-- Chọn tháng -->
            <div class="mb-4">
                <label>Tháng</label>
                <select name="month" class="w-full border p-2 rounded">
                    <?php for($i=1;$i<=12;$i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($month== $i ? 'selected' :''); ?>>
                        Tháng <?php echo e($i); ?>

                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            
            <!-- Chọn năm -->
            <div class="mb-4">
                <label>Năm</label>
                <select name="year" class="w-full border p-2 rounded">
                    <?php for($i=2001; $i<=2099; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($year== $i ? 'selected' :''); ?>>
                        Năm <?php echo e($i); ?>

                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Button -->
            <button type="submit" name="filter_year"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Thống kê theo năm
            </button>

            <button type="submit" name="filter_month"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Thống kê theo tháng / năm
            </button>

        </form>
        <br>
        <div class="grid grid-cols-4 gap-6">
            <?php if(!is_null($totalYearSalary)): ?>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Tổng lương năm <?php echo e($year); ?></h3>
                <p class="text-3xl font-bold text-green-600"><?php echo e($totalYearSalary); ?> VNĐ</p>
            </div>
            <?php endif; ?>
            <?php if(!is_null($totalMonthSalary)): ?>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Tổng lương tháng <?php echo e($month); ?> / năm <?php echo e($year); ?></h3>
                <p class="text-3xl font-bold text-purple-600"><?php echo e($totalMonthSalary); ?> VNĐ</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
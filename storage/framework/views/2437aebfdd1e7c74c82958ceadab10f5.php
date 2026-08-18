<?php $__env->startSection('title', 'Thống kê nâng cao'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thống kê nâng cao</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row g-4">
        <h1 class="text-2xl font-bold mb-6">
            Tổng chi phí lương theo tháng và năm
        </h1>
        <form action="/admin/dashboard" method="get" class="bg-white p-6 rounded shadow w-1/2">
            <?php echo csrf_field(); ?>
            <!-- Chọn tháng -->
            <div class="mb-4">
                <label>Tháng</label>
                <select name="month" class="w-full border p-2 rounded">
                    <?php for($i=1;$i<=12;$i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($month == $i ? 'selected' :''); ?>>
                        Tháng <?php echo e($i); ?>

                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            
            <!-- Chọn năm -->
            <div class="mb-4">
                <label>Năm</label>
                <select name="year" class="w-full border p-2 rounded">
                    <?php for($i=2001; $i<=2099; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($year == $i ? 'selected' :''); ?>>
                        Năm <?php echo e($i); ?>

                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Button -->
            <button name="filter_month"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Thống kê">
                Thống kê
            </button>

        </form>
        <br>
        <div class="bg-white p-6 rounded shadow w-1/2">
            <?php if(!is_null($totalMonthSalary)): ?>
                <h3 class="text-gray-500">Tổng lương tháng <?php echo e($month); ?> / năm <?php echo e($year); ?></h3>
                <p class="text-3xl font-bold text-purple-600"><?php echo e(number_format($totalMonthSalary)); ?> VNĐ</p>
            <?php endif; ?>
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Tổng chi phí lương theo năm
        </h1>
        <form action="/admin/dashboard" method="get" class="bg-white p-6 rounded shadow w-1/2">
            <?php echo csrf_field(); ?>
            <!-- Chọn năm -->
            <div class="mb-4">
                <label>Năm</label>
                <select name="year" class="w-full border p-2 rounded">
                    <?php for($i=2001; $i<=2099; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($year == $i ? 'selected' :''); ?>>
                        Năm <?php echo e($i); ?>

                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Button -->
            <button name="filter_year"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Thống kê">
                Thống kê
            </button>

        </form>
        <br>
        <div class="bg-white p-6 rounded shadow w-1/2">
            <?php if(!is_null($totalYearSalary)): ?>
                <h3 class="text-gray-500">Tổng lương năm <?php echo e($year); ?></h3>
                <p class="text-3xl font-bold text-green-600"><?php echo e(number_format($totalYearSalary)); ?> VNĐ</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\phamt\Desktop\example-app\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
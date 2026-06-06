<?php $__env->startSection('title', 'Quản lý chức vụ'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý chức vụ</title>
</head>
<body>
    <a href="/positions/export"
    class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
        Xuất file Excel
    </a>
    <form method="GET" action="/positions" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="<?php echo e($search); ?>" class="border p-2" placeholder="Tìm theo tên chức vụ hoặc lương cơ bản" style="width:350px;">
        <button class="bg-gray-500 text-white px-3 py-2 rounded">Tìm</button>
    </form>
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Tên chức vụ</th>
                    <th class="p-3">Lương cơ bản</th>
                </tr>
            </thead>
        <tbody>
        <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b">
                <td class="p-3"><?php echo e($position->name); ?></td>
                <td class="p-3"><?php echo e($position->base_salary); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/user/position.blade.php ENDPATH**/ ?>
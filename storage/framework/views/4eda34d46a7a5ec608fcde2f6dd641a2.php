<?php $__env->startSection('title', 'Quản lý công việc'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý công việc</title>
</head>
<body>
    <a href="/positions/create"
    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Thêm công việc
    </a>
    <a href="/positions/export"
    class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
        Xuất file Excel
    </a>
    <form method="GET" action="/positions" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="<?php echo e($search); ?>" class="border p-2" placeholder="Tìm theo tên công việc hoặc lương cơ bản" style="width:350px;">
        <button class="bg-gray-500 text-white px-3 py-2 rounded">Tìm</button>
    </form>
    <?php if(session('success')): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-200 text-red-800 p-3 rounded mt-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Tên công việc</th>
                    <th class="p-3">Lương cơ bản</th>
                    <th class="p-3">Lương cao nhất</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
        <tbody>
        <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b">
                <td class="p-3"><?php echo e($position->name); ?></td>
                <td class="p-3"><?php echo e($position->base_salary); ?></td>
                <td class="p-3"><?php echo e($position->max_salary); ?></td>
                <td class="p-3 space-x-2">
                    <a href="/positions/edit/<?php echo e($position->id); ?>"
                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Sửa
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/user/positions/index.blade.php ENDPATH**/ ?>
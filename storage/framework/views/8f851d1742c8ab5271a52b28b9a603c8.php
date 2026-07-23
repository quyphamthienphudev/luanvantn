<?php $__env->startSection('title','Quản lý nhân viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý nhân viên</title>
</head>

<body>
    <form action="/qlcl/employees" method="get" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="<?php echo e($search); ?>" class="border p-2" style="width:400px;"
        placeholder="Tìm theo mã nhân viên hoặc họ tên nhân viên">
        <button class="bg-gray-500 text-white px-3 py-2 rounded" title="Tìm">Tìm</button>
    </form>

    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Mã nhân viên</th>
                    <th class="p-3">Họ tên nhân viên</th>
                    <th class="p-3">Phòng ban</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($e->employee_code); ?></td>
                    <td class="p-3"><?php echo e($e->full_name); ?></td>
                    <td class="p-3"><?php echo e($e->department->name); ?></td>
                    <td class="p-3 space-x-2">
                        <a href="/qlcl/employees/show/<?php echo e($e->id); ?>" class="bg-blue-500 text-white px-3 py-1 rounded" title="Xem chi tiết">Xem
                            chi tiết</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="border-b">
                    <td colspan="4" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/qlcl/employees/index.blade.php ENDPATH**/ ?>
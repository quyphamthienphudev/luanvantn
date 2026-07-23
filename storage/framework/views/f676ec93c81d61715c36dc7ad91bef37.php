<?php $__env->startSection('title','Quản lý khen thưởng'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý khen thưởng</title>
</head>

<body>
    <a href="/hcns/rewards/create" class="bg-blue-600 text-white px-4 py-2 rounded">
        Thêm khen thưởng
    </a>

    <?php if(session('success')): ?>
    <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Tên nhân viên</th>
                    <th class="p-3">Nội dung khen thưởng</th>
                    <th class="p-3">Số tiền</th>
                    <th class="p-3">Ngày ra quyết định</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($r->employee->full_name); ?></td>
                    <td class="p-3"><?php echo e($r->title); ?></td>
                    <td class="p-3"><?php echo e($r->amount); ?></td>
                    <td class="p-3"><?php echo e($r->decision_date ? date('d/m/Y', strtotime($r->decision_date)) : ''); ?></td>
                    <td class="p-3 space-x-2">
                        <a href="/hcns/rewards/edit/<?php echo e($r->id); ?>"
                            class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
                        <a href="/hcns/rewards/delete/<?php echo e($r->id); ?>" class="bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Bạn có muốn xoá khen thưởng này ?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="border-b">
                    <td colspan="5" class="text-center py-10 text-gray-500">Chưa có dữ liệu</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/hcns/rewards/index.blade.php ENDPATH**/ ?>
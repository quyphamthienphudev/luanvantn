<?php $__env->startSection('title','Quản lý hồ sơ ứng viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý hồ sơ ứng viên</title>
</head>
<body>
    <a href="/admin/candidates/create" class="bg-blue-600 text-white px-4 py-2 rounded">
        Thêm hồ sơ ứng viên
    </a>

    <form method="GET" action="/admin/candidates" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="<?php echo e($search); ?>" class="border p-2" placeholder="Tìm theo mã hồ sơ hoặc họ tên" style="width:300px;">
        <button class="bg-gray-500 text-white px-3 py-2 rounded">Tìm</button>
    </form>

    <?php if(session('success')): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Mã hồ sơ</th>
                    <th class="p-3">Họ tên</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>

        <tbody>
            <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($c->candidate_id); ?></td>
                    <td class="p-3"><?php echo e($c->full_name); ?></td>
                    <td class="p-3 space-x-2">
                        <a href="/admin/candidates/show/<?php echo e($c->id); ?>" class="bg-blue-500 text-white px-3 py-1 rounded">Xem</a>
                        <a href="/admin/candidates/edit/<?php echo e($c->id); ?>" class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
                        <a href="/admin/candidates/delete/<?php echo e($c->id); ?>" class="bg-red-600 text-white px-3 py-1 rounded"
                        onclick="return confirm('Bạn có muốn xoá hồ sơ ứng viên này ?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>

</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/admin/candidates/index.blade.php ENDPATH**/ ?>
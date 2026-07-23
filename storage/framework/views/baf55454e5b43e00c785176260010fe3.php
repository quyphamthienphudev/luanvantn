<?php $__env->startSection('title', 'Đổi mật khẩu'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Đổi mật khẩu</title>
</head>

<body>
    <div class="bg-white p-6 rounded-xl shadow w-1/2">
        <?php if(session('error')): ?>
        <div class="text-red-600 mb-4">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>
        <?php if(session('success')): ?>
        <div class="text-green-600 mb-4">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
        <div class="text-red-600 mb-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>
        <form method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block mb-2">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" class="w-full px-4 py-2 border rounded"
                    placeholder="Mật khẩu hiện tại">
            </div>
            <div class="mb-4">
                <label class="block mb-2">Mật khẩu mới</label>
                <input type="password" name="new_password" class="w-full px-4 py-2 border rounded"
                    placeholder="Mật khẩu mới">
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Đổi mật khẩu
            </button>
        </form>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/change-password.blade.php ENDPATH**/ ?>
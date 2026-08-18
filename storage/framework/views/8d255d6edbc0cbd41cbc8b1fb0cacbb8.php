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
        <form method="post">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block mb-2">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" class="w-full px-4 py-2 border rounded"
                    placeholder="Mật khẩu hiện tại" value="<?php echo e(old('current_password')); ?>">
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-4">
                <label class="block mb-2">Mật khẩu mới</label>
                <input type="password" name="new_password" class="w-full px-4 py-2 border rounded"
                    placeholder="Mật khẩu mới" value="<?php echo e(old('new_password')); ?>">
                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded" title="Đổi mật khẩu">
                Đổi mật khẩu
            </button>
        </form>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\phamt\Desktop\example-app\resources\views/change-password.blade.php ENDPATH**/ ?>
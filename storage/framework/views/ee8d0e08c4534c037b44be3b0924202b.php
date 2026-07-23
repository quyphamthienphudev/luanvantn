<?php $__env->startSection('title', 'Cập nhật thông tin cá nhân'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin cá nhân</title>
</head>

<body>
    <div class="bg-white p-6 rounded-xl shadow w-1/2">
        <?php if(session('success')): ?>
        <div class="text-green-600 mb-4">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="text-green-600 mb-4">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>
        <form method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block mb-2">Họ tên</label>
                <input type="text" name="name" value="<?php echo e(auth()->user()->name); ?>"
                    class="w-full px-4 py-2 border rounded" placeholder="Họ tên">
                <?php $__errorArgs = ['name'];
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
                <label class="block mb-2">Email</label>
                <input type="text" name="email" value="<?php echo e(auth()->user()->email); ?>"
                    class="w-full px-4 py-2 border rounded" placeholder="Email" maxlength="150">
                <?php $__errorArgs = ['email'];
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
            <button class="bg-blue-600 text-white px-4 py-2 rounded" title="Cập nhật">
                Cập nhật
            </button>
        </form>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\LVTN copy\resources\views/profile.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm quyền truy cập</title>
</head>

<body>
    <a href="/httt/roles" class="btn btn-secondary" title="← Quay lại">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Thêm quyền truy cập
    </h1>
    <form action="/httt/roles/store" method="POST" class="bg-white p-6 rounded shadow w-1/2">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label>Tên quyền truy cập</label>
            <input type="text" name="name" class="w-full border p-2 rounded" placeholder="Tên quyền truy cập" maxlength="50" value="<?php echo e(old('name')); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="mb-4">
            <label>Mô tả</label>
            <input type="text" name="description" class="w-full border p-2 rounded" placeholder="Mô tả" value="<?php echo e(old('description')); ?>">
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Lưu">
            Lưu
        </button>
    </form>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/httt/roles/create.blade.php ENDPATH**/ ?>
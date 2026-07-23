<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin công việc</title>
</head>

<body>
    <a href="/hcns/positions" class="btn btn-secondary" title="← Quay lại">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Cập nhật thông tin công việc
    </h1>
    <form action="/hcns/positions/update/<?php echo e($position->id); ?>" method="POST" class="bg-white p-6 rounded shadow w-1/2">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label>Tên công việc</label>
            <input type="text" name="name" value="<?php echo e($position->name); ?>" class="w-full border p-2 rounded"
                placeholder="Tên công việc" maxlength="100">
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
            <label>Lương cơ bản</label>
            <input type="text" name="base_salary" value="<?php echo e($position->base_salary); ?>" class="w-full border p-2 rounded"
                placeholder="Lương cơ bản">
            <?php $__errorArgs = ['base_salary'];
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
            <label>Lương cao nhất</label>
            <input type="text" name="max_salary" value="<?php echo e($position->max_salary); ?>" class="w-full border p-2 rounded"
                placeholder="Lương cao nhất">
            <?php $__errorArgs = ['max_salary'];
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
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" title="Cập nhật">
            Cập nhật
        </button>
    </form>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/positions/edit.blade.php ENDPATH**/ ?>
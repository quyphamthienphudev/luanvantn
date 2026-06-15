<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật quyền truy cập</title>
</head>
<body>
    <a href="/admin/roles" class="btn btn-secondary">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Cập nhật quyền truy cập
    </h1>
    <form action="/admin/roles/update/<?php echo e($roles->id); ?>" method="POST"
    class="bg-white p-6 rounded shadow w-1/2">
        <?php echo csrf_field(); ?>
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
        <div class="mb-4">
            <label>ID</label>
            <input type="text" name="id"
            value="<?php echo e($roles->id); ?>"
            class="w-full border p-2 rounded bg-gray-100" placeholder="ID" readonly>
        </div>
        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name"
            value="<?php echo e($roles->name); ?>"
            class="w-full border p-2 rounded bg-gray-100" placeholder="Name" readonly>
        </div>
        <div class="mb-4">
            <label>Mô tả</label>
            <input type="text" name="description"
            value="<?php echo e($roles->description); ?>"
            class="w-full border p-2 rounded" placeholder="Name">
        </div>
        <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cập nhật
        </button>
    </form>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/admin/roles/edit.blade.php ENDPATH**/ ?>
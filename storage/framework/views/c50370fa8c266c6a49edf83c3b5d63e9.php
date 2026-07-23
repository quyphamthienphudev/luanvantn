<?php $__env->startSection('title','Gia hạn hợp đồng lao động'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Gia hạn hợp đồng lao động</title>
</head>

<body>
    <a href="/hcns/contracts" title="← Quay lại">← Quay lại</a>
    <form method="POST" action="/hcns/contracts/extend/<?php echo e($contract->id); ?>" class="bg-white p-6 w-1/2">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label>Mã hợp đồng</label>
            <input type="text" name="" value="<?php echo e($contract->contract_code); ?>"
                class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Nhân viên</label>
            <input type="text" name="" value="<?php echo e($contract->employee->full_name); ?>"
                class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Ngày bắt đầu</label>
            <input type="date" name="" value="<?php echo e($contract->end_date); ?>" class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Ngày kết thúc</label>
            <input type="date" name="end_date" class="w-full border p-2 rounded">
            <?php $__errorArgs = ['end_date'];
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
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" title="Gia hạn">Gia hạn</button>
    </form>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/contracts/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title','Cập nhật thông tin khen thưởng'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin khen thưởng</title>
</head>

<body>
    <a href="/hcns/rewards" title="← Quay lại">← Quay lại</a>
    <form method="POST" action="/hcns/rewards/update/<?php echo e($rewards->id); ?>" class="bg-white p-6 w-1/2">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label>Nhân viên</label>
            <input type="text" value="<?php echo e($rewards->employee->full_name); ?>" class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Mã nhân viên</label>
            <input type="text" value="<?php echo e($rewards->employee->employee_code); ?>" class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Nội dung khen thưởng</label>
            <input type="text" name="title" value="<?php echo e($rewards->title); ?>" class="w-full border p-2 rounded"
                placeholder="Nội dung khen thưởng">
            <?php $__errorArgs = ['title'];
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
            <label>Số tiền</label>
            <input type="text" name="amount" value="<?php echo e($rewards->amount); ?>" class="w-full border p-2 rounded"
                placeholder="Số tiền">
            <?php $__errorArgs = ['amount'];
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
            <label>Ngày ra quyết định</label>
            <input type="date" name="decision_date" value="<?php echo e($rewards->decision_date); ?>"
                class="w-full border p-2 rounded">
            <?php $__errorArgs = ['decision_date'];
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
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" title="Cập nhật">Cập nhật</button>
    </form>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/rewards/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title','Thêm kỷ luật'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm kỷ luật</title>
</head>
<body>
    <a href="/hcns/disciplines">← Quay lại</a>
    <form method="POST" action="/hcns/disciplines/store" class="bg-white p-6 rounded shadow w-1/2">
    <?php echo csrf_field(); ?>
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
        <div class="mb-4">
            <label>Chọn nhân viên</label>
            <select name="employee_id" class="w-full border p-2 rounded">
            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($e->id); ?>"><?php echo e($e->full_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-4">
            <label>Nội dung kỷ luật</label>
            <input type="text" name="title" class="w-full border p-2 rounded" placeholder="Nội dung kỷ luật">
        </div>
        <div class="mb-4">
            <label>Số tiền</label>
            <input type="text" name="amount" class="w-full border p-2 rounded" placeholder="Số tiền">
        </div>
        <div class="mb-4">
            <label>Ngày ra quyết định</label>
            <input type="date" name="decision_date" class="w-full border p-2 rounded">
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lưu</button>
    </form>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/hcns/disciplines/create.blade.php ENDPATH**/ ?>
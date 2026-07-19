<?php $__env->startSection('title', 'Sửa bảng lương'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin bảng lương</title>
</head>
<body>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">Cập nhật thông tin bảng lương</h2>
    <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <form action="/payrolls/update/<?php echo e($payroll->id); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nhân viên</label>
            <select name="employee_id" class="w-full border rounded px-3 py-2" required>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($employee->id); ?>" <?php echo e($payroll->employee_id == $employee->id ? 'selected' : ''); ?>>
                        <?php echo e($employee->employee_code); ?> - <?php echo e($employee->full_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tháng</label>
                <select name="month" class="w-full border rounded px-3 py-2" required>
                    <?php for($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e($payroll->month == $i ? 'selected' : ''); ?>>Tháng <?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Năm</label>
                <select name="year" class="w-full border rounded px-3 py-2" required>
                    <?php for($i = 2020; $i <= date('Y')+1; $i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e($payroll->year == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Thưởng (VNĐ)</label>
                <input type="number" name="bonus" class="w-full border rounded px-3 py-2" value="<?php echo e($payroll->bonus); ?>" min="0">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Khấu trừ (VNĐ)</label>
                <input type="number" name="deduction" class="w-full border rounded px-3 py-2" value="<?php echo e($payroll->deduction); ?>" min="0">
            </div>
        </div>
        <div class="flex gap-2 justify-end">
            <a href="/payrolls" class="bg-gray-500 text-white px-4 py-2 rounded">Hủy</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập nhật</button>
        </div>
    </form>
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/user/payrolls/edit.blade.php ENDPATH**/ ?>
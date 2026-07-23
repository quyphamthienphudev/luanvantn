

<?php $__env->startSection('title','Thêm hợp đồng lao động'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm hợp đồng lao động</title>
</head>

<body>
    <a href="/hcns/contracts" title="← Quay lại">← Quay lại</a>
    <form method="POST" action="/hcns/contracts/store" class="bg-white p-6 rounded shadow w-1/2"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label>Mã hợp đồng</label>
            <input type="text" name="contract_code" class="w-full border p-2 rounded" value="<?php echo e(old('contract_code')); ?>">
            <?php $__errorArgs = ['contract_code'];
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
            <label>Nhân viên</label>
            <select name="employee_id" id="employee_id" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($employee->id); ?>">
                    <?php echo e($employee->full_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-4">
            <label>Mã nhân viên</label>
            <input type="text" id="employee_code" class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Loại hợp đồng</label>
            <select name="contract_type" class="w-full border p-2 rounded">
                <option value="probation">Hợp đồng thử việc</option>
                <option value="fixed_term">Hợp đồng xác định thời hạn</option>
                <option value="indefinite">Hợp đồng không xác định thời hạn</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Ngày bắt đầu</label>
            <input type="date" name="start_date" class="w-full border p-2 rounded" value="<?php echo e(old('start_date')); ?>">
            <?php $__errorArgs = ['start_date'];
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
            <label>Ngày kết thúc</label>
            <input type="date" name="end_date" class="w-full border p-2 rounded" value="<?php echo e(old('end_date')); ?>">
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
        <div class="mb-4">
            <label>Mức lương</label>
            <input type="text" name="salary" class="w-full border p-2 rounded" placeholder="Mức lương" value="<?php echo e(old('salary')); ?>">
            <?php $__errorArgs = ['salary'];
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
            <label>File hợp đồng</label>
            <input type="file" name="contract_file" class="w-full border p-2 rounded" accept=".pdf,.doc,.docx" value="<?php echo e(old('contract_file')); ?>">
            <?php $__errorArgs = ['contract_file'];
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
            <label>Ghi chú hợp đồng</label>
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
            <textarea name="description" class="w-full border p-2 rounded" rows="10" cols="40"><?php echo e(old('description')); ?></textarea>
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Lưu">Lưu</button>
    </form>
    <!-- javascript cập nhật mã nhân viên khi thay đổi chọn nhân viên -->
    <script>
        const employees = <?php echo json_encode($employees, 15, 512) ?>;

        const employeeSelect = document.getElementById('employee_id');
        const employeeCodeInput = document.getElementById('employee_code');

        function updateEmployeeCode() {
            let employeeId = employeeSelect.value;

            let employee = employees.find(
                item => item.id == employeeId
            );

            if (employee) {
                employeeCodeInput.value = employee.employee_code;
            }
        }

        employeeSelect.addEventListener('change', updateEmployeeCode);

        updateEmployeeCode();
    </script>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/contracts/create.blade.php ENDPATH**/ ?>
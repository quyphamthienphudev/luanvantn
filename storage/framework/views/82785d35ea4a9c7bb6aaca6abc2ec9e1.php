<?php $__env->startSection('title', 'Sửa bảng lương'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Sửa bảng lương</title>
</head>

<body>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Sửa bảng lương</h2>
        <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>
        <form action="/hcns/payrolls/update/<?php echo e($payroll->id); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nhân viên</label>
                <select name="employee_id" id="employee_id" class="w-full border rounded px-3 py-2">
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($e->id); ?>" <?php echo e($payroll->employee_id == $e->id ? 'selected' : ''); ?>>
                        <?php echo e($e->full_name); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Mã nhân viên</label>
                <input type="text" id="employee_code" class="w-full border p-2 rounded bg-gray-100" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Công việc</label>
                <input type="text" id="position_name" class="w-full border p-2 rounded bg-gray-100" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Lương cơ bản (VNĐ)</label>
                <input type="text" id="base_salary" class="w-full border p-2 rounded bg-gray-100" readonly>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Tháng</label>
                    <select name="month" class="w-full border rounded px-3 py-2">
                        <?php for($i = 1; $i <= 12; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($payroll->month == $i ? 'selected' : ''); ?>>Tháng <?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Năm</label>
                    <select name="year" class="w-full border rounded px-3 py-2">
                        <?php for($i = 2001; $i <= 2099; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($payroll->year == $i ? 'selected' : ''); ?>>Năm <?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Phụ cấp (VNĐ)</label>
                <input type="text" name="allowance" value="<?php echo e($request->allowance); ?>" class="w-full border p-2 rounded" placeholder="Phụ cấp">
                <?php $__errorArgs = ['allowance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-red-700"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Thưởng (VNĐ)</label>
                    <input type="number" class="w-full border rounded px-3 py-2 bg-gray-100"
                        value="<?php echo e($payroll->bonus); ?>" readonly>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Khấu trừ (VNĐ)</label>
                    <input type="number" class="w-full border rounded px-3 py-2 bg-gray-100"
                        value="<?php echo e($payroll->deduction); ?>" readonly>
                </div>
            </div>

            <div class="flex gap-2 justify-end">
                <a href="/hcns/payrolls" class="bg-gray-500 text-white px-4 py-2 rounded" title="Huỷ">Huỷ</a>
                <button class="bg-blue-500 text-white px-4 py-2 rounded" title="Cập nhật">Cập nhật</button>
            </div>
        </form>
    </div>
    <!-- javascript cập nhật mã nhân viên khi thay đổi chọn nhân viên -->
    <script>
        const employees = <?php echo json_encode($employees, 15, 512) ?>;

        const employeeSelect = document.getElementById('employee_id');
        const employeeCodeInput = document.getElementById('employee_code');
        const positionNameInput = document.getElementById('position_name');
        const baseSalaryInput = document.getElementById('base_salary');

        function updateEmployeeCode() {
            let employeeId = employeeSelect.value;

            let employee = employees.find(
                item => item.id == employeeId
            );

            if (employee) {
                employeeCodeInput.value = employee.employee_code;
                positionNameInput.value = employee.position_name;
                baseSalaryInput.value = employee.base_salary;
            }
        }

        employeeSelect.addEventListener('change', updateEmployeeCode);

        updateEmployeeCode();
    </script>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/payrolls/edit.blade.php ENDPATH**/ ?>
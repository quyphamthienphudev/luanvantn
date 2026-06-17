<?php $__env->startSection('title','Chi tiết nhân viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Chi tiết nhân viên</title>
</head>

<body>
    <a href="/hcns/employees">← Quay lại</a>
    <div class="bg-white p-6">
        <p>Mã nhân viên: <?php echo e($employee->employee_code); ?></p>
        <p>Họ tên nhân viên: <?php echo e($employee->full_name); ?></p>
        <p>Phòng ban: <?php echo e($employee->department->name); ?></p>
        <p>Email: <?php echo e($employee->email); ?></p>
        <p>Công việc: <?php echo e($employee->position->name); ?></p>
        <p>Giới tính:
            <?php if($employee->gender == 'male'): ?>
            Nam
            <?php else: ?>
            Nữ
            <?php endif; ?>
        </p>
        <p>Ngày sinh: <?php echo e($employee->date_of_birth ? date('d/m/Y', strtotime($employee->date_of_birth)) : ''); ?></p>
        <p>SĐT: <?php echo e($employee->phone); ?></p>
        <p>Địa chỉ: <?php echo e($employee->address); ?> , <?php echo e($employee->street); ?> , <?php echo e($employee->ward); ?> , <?php echo e($employee->province); ?></p>
        <p>Ngày vào làm:
            <?php echo e($employee->hire_date ? date('d/m/Y', strtotime($employee->hire_date)) : ''); ?>

        </p>
        <p>Trạng thái:
            <?php if($employee->status == 'working'): ?>
            Đang làm việc
            <?php else: ?>
            Đã nghỉ việc
            <?php endif; ?>
        </p>
        <hr class="my-4">
        <h3 class="font-bold text-lg">
            Chứng chỉ
        </h3>
        <form method="POST" action="/hcns/employees/<?php echo e($employee->id); ?>/certificate/store"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php $__errorArgs = ['certificate_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['issue_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['expiry_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['certificate_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="mb-3">
                <label>Tên chứng chỉ</label>
                <input type="text" name="certificate_name" class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label>Ngày cấp</label>
                <input type="date" name="issue_date" class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label>Ngày hết hạn</label>
                <input type="date" name="expiry_date" class="border p-2 w-full">
            </div>

            <div class="mb-3">
                <label>File chứng chỉ</label>
                <input type="file" name="certificate_file" class="border p-2 w-full">
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Tải lên</button>
        </form>
        <hr class="my-4">
        <h3 class="font-bold text-lg">Danh sách chứng chỉ</h3>
        <table class="w-full border">
            <tr>
                <td style="font-weight:bold;">Tên chứng chỉ</td>
                <td style="font-weight:bold;">Ngày cấp</td>
                <td style="font-weight:bold;">Ngày hết hạn</td>
                <td style="font-weight:bold;">File</td>
            </tr>
            <?php $__currentLoopData = $employee->certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($c->certificate_name); ?></td>
                <td>
                    <?php echo e($c->issue_date ? date('d/m/Y', strtotime($c->issue_date)) : ''); ?>

                </td>
                <td>
                    <?php echo e($c->expiry_date ? date('d/m/Y', strtotime($c->expiry_date)) : ''); ?>

                </td>
                <td>
                    <?php if($c->certificate_file == ''): ?>
                    <a href="" style="color:blue; font-weight:bold;">Xem
                        file</a>
                    <?php else: ?>
                    <a href="/hcns/employees/certificate/view/<?php echo e($c->id); ?>" target="_blank" style="color:blue; font-weight:bold;">Xem
                        file</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/hcns/employees/show.blade.php ENDPATH**/ ?>
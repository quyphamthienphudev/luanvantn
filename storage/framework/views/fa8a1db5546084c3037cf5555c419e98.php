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
    <a href="/employees">← Quay lại</a>
    <div class="bg-white p-6">
        <p>Mã nhân viên: <?php echo e($employee->employee_code); ?></p>
        <p>Họ tên nhân viên: <?php echo e($employee->full_name); ?></p>
        <p>Phòng ban: <?php echo e($employee->department->name); ?></p>
        <p>Email: <?php echo e($employee->email); ?></p>
        <p>Chức vụ: <?php echo e($employee->position->name); ?></p>
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
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/user/employees/show.blade.php ENDPATH**/ ?>
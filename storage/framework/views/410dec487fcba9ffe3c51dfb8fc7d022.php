<?php $__env->startSection('title','Chi tiết hồ sơ ứng viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Chi tiết hồ sơ ứng viên</title>
</head>

<body>
    <a href="/hcns/candidates" title="← Quay lại">← Quay lại</a>
    <div class="bg-white p-6">
        <p>Mã hồ sơ: <?php echo e($candidate->candidate_id); ?></p>
        <p>Họ và tên: <?php echo e($candidate->full_name); ?></p>
        <p>Tên: <?php echo e($candidate->first_name); ?></p>
        <p>Họ: <?php echo e($candidate->last_name); ?></p>
        <p>Giới tính:
            <?php if($candidate->gender == 'male'): ?>
            Nam
            <?php else: ?>
            Nữ
            <?php endif; ?>
        </p>
        <p>Ngày sinh: <?php echo e($candidate->date_of_birth ? date('d/m/Y', strtotime($candidate->date_of_birth)) : ''); ?></p>
        <p>SĐT: <?php echo e($candidate->phone); ?></p>
        <p>Học vấn: <?php echo e($candidate->education); ?></p>
        <p>Email: <?php echo e($candidate->email); ?></p>
        <p>Địa chỉ: <?php echo e($candidate->address); ?>, <?php echo e($candidate->street); ?>, <?php echo e($candidate->ward); ?>, <?php echo e($candidate->province); ?></p>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/candidates/show.blade.php ENDPATH**/ ?>
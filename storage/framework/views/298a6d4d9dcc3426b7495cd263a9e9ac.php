<?php $__env->startSection('title', 'Quản lý nghỉ phép'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý nghỉ phép</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .table th { vertical-align: middle; }
        .status-badge { width: 100px; display: inline-block; text-align: center; }
        .action-group { white-space: nowrap; }
        .btn-action { width: 32px; height: 32px; padding: 0; line-height: 32px; border-radius: 6px; }
    </style>
</head>
<body>
    <?php if(session('success')): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
        <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Nhân viên</th>
                    <th class="p-3">Lý do nghỉ phép</th>
                    <th class="p-3">Thời gian</th>
                    <th class="p-3">Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
        <tbody>
        <?php $__currentLoopData = $allLeaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b">
                <td class="ps-3">
                    <div class="fw-bold"><?php echo e($leave->user->name ?? $leave->employee->full_name ?? 'N/A'); ?></div>
                    <small class="text-muted">Mã nhân viên: <?php echo e($leave->user->id ?? $leave->employee->employee_code); ?></small>
                </td>
                <td class="ps-3">
                    <div><?php echo e($leave->reason); ?></div>
                </td>
                <td class="ps-3">
                    <div class="small fw-bold text-dark"><?php echo e(\Carbon\Carbon::parse($leave->start_date)->format('d/m/Y')); ?></div>
                    <div class="small text-muted">đến <?php echo e(\Carbon\Carbon::parse($leave->end_date)->format('d/m/Y')); ?></div>
                </td>
                <td class="ps-3">
                    <?php if($leave->status == 'pending'): ?>
                    <span class="badge bg-warning text-dark status-badge">Chờ duyệt</span>
                    <?php elseif($leave->status == 'approved'): ?>
                    <span class="badge bg-success status-badge">Đã duyệt</span>
                    <?php elseif($leave->status == 'rejected'): ?>
                    <span class="badge bg-danger status-badge">Từ chối</span>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-2 action-group ">
                    <?php if($leave->status == 'pending'): ?>
                    <form action="/admin/leave/approve/<?php echo e($leave->id); ?>" method="POST" class="m-0 p-0">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-success btn-sm btn-action" title="Duyệt"><i class="fas fa-check"></i></button>
                    </form>
                    <form action="/admin/leave/reject/<?php echo e($leave->id); ?>" method="POST" class="m-0 p-0" onsubmit="return confirm('Từ chối đơn nghỉ phép này ?')">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-outline-danger btn-sm btn-action" title="Từ chối"><i class="fas fa-ban"></i></button>
                    </form>
                    <form action="/admin/leave/edit/<?php echo e($leave->id); ?>" method="GET" class="m-0 p-0">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-success btn-sm btn-action" title="Chỉnh sửa"><i class="fas fa-edit"></i></button>
                    </form>
                    <?php endif; ?>
                    <form action="/admin/leave/delete/<?php echo e($leave->id); ?>" method="POST" class="m-0 p-0" onsubmit="return confirm('Bạn có muốn xóa đơn xin nghỉ phép này?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm btn-action" title="Xóa"><i class="fas fa-trash"></i></button>
                    </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/admin/leave/index.blade.php ENDPATH**/ ?>
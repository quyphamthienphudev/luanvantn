<title>Hệ thống quản lý nhân sự - Quản lý nghỉ phép</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .table th {
        vertical-align: middle;
    }

    .status-badge {
        width: 100px;
        display: inline-block;
        text-align: center;
    }

    .action-group {
        white-space: nowrap;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        line-height: 32px;
        border-radius: 6px;
    }
</style>



<?php $__env->startSection('title', 'Quản lý nghỉ phép'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
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
                <th class="p-3">Số ngày nghỉ</th>
                <th class="p-3">Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $allLeaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-b">
                <td class="ps-3">
                    <div class="fw-bold"><?php echo e($leave->name ?? 'N/A'); ?></div>
                    <small class="text-muted">Mã nhân viên: <?php echo e($leave->employee_code); ?></small>
                </td>
                <td class="ps-3">
                    <div><?php echo e($leave->reason); ?></div>
                </td>
                <td class="ps-3">
                    <div class="small fw-bold text-dark"><?php echo e($leave->start_date ? date('d/m/Y', strtotime($leave->start_date)) : ''); ?></div>
                    <div class="small text-muted">đến <?php echo e($leave->end_date ? date('d/m/Y', strtotime($leave->end_date)) : ''); ?></div>
                </td>
                <td class="ps-3">
                    <div><b><?php echo e($leave->number_days); ?> ngày</b></div>
                </td>
                <td class="ps-3">
                    <?php if($leave->status == 'pending'): ?>
                    <span class="badge bg-warning text-dark status-badge">Chờ duyệt</span>
                    <?php elseif($leave->status == 'approved'): ?>
                    <span class="badge bg-success status-badge">Đã duyệt</span>
                    <?php else: ?>
                    <span class="badge bg-danger status-badge">Từ chối</span>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-2 action-group ">
                        <?php if($leave->status == 'pending'): ?>
                        <form action="/qlcl/leave/approve/<?php echo e($leave->id); ?>" method="post" class="m-0 p-0"
                            onsubmit="return confirm('Bạn có muốn duyệt đơn xin nghỉ phép này ?')">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-success btn-sm btn-action" title="Duyệt"><i
                                    class="fas fa-check"></i></button>
                        </form>

                        <form action="/qlcl/leave/reject/<?php echo e($leave->id); ?>" method="post" class="m-0 p-0"
                            onsubmit="return confirm('Bạn có muốn từ chối đơn xin nghỉ phép này ?')">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-danger btn-sm btn-action" title="Từ chối"><i
                                    class="fas fa-ban"></i></button>
                        </form>

                        <button class="btn btn-info btn-sm btn-action text-white" title="Chỉnh sửa">
                            <a href="/qlcl/leave/edit/<?php echo e($leave->id); ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </button>
                        <?php endif; ?>
                        
                        <button class="btn btn-danger btn-sm btn-action" 
                            title="Xoá" onclick="return confirm('Bạn có muốn xóa đơn xin nghỉ phép này?')">
                                <a href="/qlcl/leave/delete/<?php echo e($leave->id); ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr class="border-b">
                <td colspan="5" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
            </tr>
            <?php endif; ?>
        </tbody>

    </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/qlcl/leave/index.blade.php ENDPATH**/ ?>
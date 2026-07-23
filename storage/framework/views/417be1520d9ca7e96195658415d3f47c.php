<title>Hệ thống quản lý nhân sự - Chỉnh sửa đơn xin nghỉ phép</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    body {
        background-color: #f4f7f6;
    }

    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(45deg, #0d6efd, #004fb1);
        border: none;
        padding: 1.5rem;
    }

    .form-label {
        color: #495057;
        font-size: 0.9rem;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }

    .btn-save {
        background: #0d6efd;
        color: white;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
    }

    .btn-save:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    .btn-cancel {
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>



<?php $__env->startSection('content'); ?>

<a href="/qlcl/leave" class="btn btn-secondary">
    ← Quay lại
</a>
<h1 class="text-2xl font-bold mb-6">
    Chỉnh sửa đơn xin nghỉ phép
</h1>

<form action="/qlcl/leave/update/<?php echo e($leave->id); ?>" method="POST" class="bg-white p-6 rounded shadow w-1/2">

    <?php echo csrf_field(); ?>
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
    <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="form-label fw-bold small">
                Nhân viên
            </label>
            <input type="text" name="employee_code" class="form-control shadow-sm bg-gray-100" 
                value="<?php echo e($leave->user->name); ?>" readonly>
        </div>              
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="form-label fw-bold small">
                Ngày bắt đầu
            </label>
            <input type="date" name="start_date" class="form-control shadow-sm" value="<?php echo e($leave->start_date); ?>">
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label fw-bold small">
                Ngày kết thúc
            </label>
            <input type="date" name="end_date" class="form-control shadow-sm" value="<?php echo e($leave->end_date); ?>">
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label fw-bold small">
            Lý do xin nghỉ phép
        </label>
        <textarea name="reason" class="form-control shadow-sm" rows="4"><?php echo e($leave->reason); ?></textarea>
    </div>

    <div class="d-flex flex-column flex-sm-row gap-3">
        <button type="submit" class="btn btn-save flex-grow-1">
            Lưu thay đổi
        </button>
    </div>

</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/qlcl/leave/edit.blade.php ENDPATH**/ ?>
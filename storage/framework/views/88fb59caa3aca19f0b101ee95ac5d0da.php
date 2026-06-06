<?php $__env->startSection('title','Cập nhật thông tin hồ sơ ứng viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin hồ sơ ứng viên</title>
</head>
<body>
    <a href="/admin/candidates">← Quay lại</a>
    <form method="POST" action="/admin/candidates/update/<?php echo e($candidates->id); ?>" class="bg-white p-6 w-1/2">
        <?php echo csrf_field(); ?>
        <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['education'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['ward'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['province'];
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
            <label>Mã hồ sơ</label>
            <input type="text" name="candidate_id" value="<?php echo e($candidates->candidate_id); ?>" class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Họ tên ứng viên</label>
            <input type="text" name="full_name" value="<?php echo e($candidates->full_name); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tên</label>
            <input type="text" name="first_name" value="<?php echo e($candidates->first_name); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Họ</label>
            <input type="text" name="last_name" value="<?php echo e($candidates->last_name); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Giới tính</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="male" <?php echo e($candidates->gender=='male'?'selected':''); ?>>Nam</option>
                <option value="female" <?php echo e($candidates->gender=='female'?'selected':''); ?>>Nữ</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Ngày sinh</label>
            <input type="date" name="date_of_birth" value="<?php echo e($candidates->date_of_birth); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Số điện thoại</label>
            <input type="text" name="phone" value="<?php echo e($candidates->phone); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Học vấn</label>
            <input type="text" name="education" value="<?php echo e($candidates->education); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo e($candidates->email); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Địa chỉ</label>
            <input type="text" name="address" value="<?php echo e($candidates->address); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tên đường</label>
            <input type="text" name="street" value="<?php echo e($candidates->street); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Phường</label>
            <input type="text" name="ward" value="<?php echo e($candidates->ward); ?>" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tỉnh / Thành phố</label>
            <input type="text" name="province" value="<?php echo e($candidates->province); ?>" class="w-full border p-2 rounded">
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>
    </form>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/admin/candidates/edit.blade.php ENDPATH**/ ?>
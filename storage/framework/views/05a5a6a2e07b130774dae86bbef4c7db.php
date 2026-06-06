<?php $__env->startSection('title','Thêm nhân viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm nhân viên</title>
</head>
<body>
    <a href="/employees">← Quay lại</a>
    <form method="POST" action="/employees/store" class="bg-white p-6 rounded shadow w-1/2">
        <?php echo csrf_field(); ?>
        <?php $__errorArgs = ['employee_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
        <div class="mb-4">
            <label>Mã nhân viên</label>
            <input name="employee_code" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Họ tên nhân viên</label>
            <input name="full_name" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Phòng ban</label>
            <select name="department_id" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input name="email" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Chức vụ</label>
            <select name="position_id" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-4">
            <label>Giới tính</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Ngày sinh</label>
            <input type="date" name="date_of_birth" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Số điện thoại</label>
            <input name="phone" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Địa chỉ</label>
            <input name="address" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tên đường</label>
            <input name="street" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Phường</label>
            <input name="ward" class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Tỉnh / Thành phố</label>
            <input name="province" class="w-full border p-2 rounded">
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lưu</button>
    </form>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/user/employees/create.blade.php ENDPATH**/ ?>
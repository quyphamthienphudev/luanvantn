<?php $__env->startSection('title','Cập nhật thông tin nhân viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin nhân viên</title>
</head>

<body>
    <a href="/hcns/employees" title="← Quay lại">← Quay lại</a>
    <form action="/hcns/employees/update/<?php echo e($employee->id); ?>" method="post" class="bg-white p-6 w-1/2">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label>Phòng ban</label>
            <select name="department_id" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($d->id); ?>" <?php echo e($employee->department_id == $d->id ? 'selected' : ''); ?>>
                    <?php echo e($d->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-4">
            <label>Mã nhân viên</label>
            <input type="text" value="<?php echo e($employee->employee_code); ?>"
                class="w-full border p-2 rounded bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label>Họ tên nhân viên</label>
            <input type="text" name="full_name" value="<?php echo e($employee->full_name); ?>" class="w-full border p-2 rounded"
                placeholder="Họ tên nhân viên">
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
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo e($employee->email); ?>" class="w-full border p-2 rounded"
                placeholder="Email">
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
        </div>
        <div class="mb-4">
            <label>Công việc</label>
            <select name="position_id" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($p->id); ?>" <?php echo e($employee->position_id == $p->id ? 'selected' : ''); ?>>
                    <?php echo e($p->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-4">
            <label>Giới tính</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="male" <?php echo e($employee->gender == 'male' ? 'selected' : ''); ?>>Nam</option>
                <option value="female" <?php echo e($employee->gender == 'female' ? 'selected' : ''); ?>>Nữ</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Ngày sinh</label>
            <input type="date" name="date_of_birth" value="<?php echo e($employee->date_of_birth); ?>"
                class="w-full border p-2 rounded">
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
        </div>
        <div class="mb-4">
            <label>CCCD</label>
            <input type="text" name="identify" value="<?php echo e($employee->identify); ?>" class="w-full border p-2 rounded"
                placeholder="CCCD">
            <?php $__errorArgs = ['identify'];
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
            <label>Quốc tịch</label>
            <input type="text" name="national" value="<?php echo e($employee->national); ?>" class="w-full border p-2 rounded"
                placeholder="Quốc tịch">
            <?php $__errorArgs = ['national'];
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
            <label>Nơi sinh</label>
            <input type="text" name="birthplace" value="<?php echo e($employee->birthplace); ?>" class="w-full border p-2 rounded"
                placeholder="Nơi sinh">
            <?php $__errorArgs = ['birthplace'];
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
            <label>Ngày cấp</label>
            <input type="date" name="issue_date" value="<?php echo e($employee->issue_date); ?>"
                class="w-full border p-2 rounded">
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
        </div>
        <div class="mb-4">
            <label>Dân tộc</label>
            <input type="text" name="ethnic_group" value="<?php echo e($employee->ethnic_group); ?>" class="w-full border p-2 rounded"
                placeholder="Dân tộc">
            <?php $__errorArgs = ['ethnic_group'];
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
            <label>Số điện thoại</label>
            <input type="text" name="phone" value="<?php echo e($employee->phone); ?>" class="w-full border p-2 rounded"
                placeholder="Số điện thoại">
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
        </div>
        <div class="mb-4">
            <label>Địa chỉ</label>
            <input type="text" name="address" value="<?php echo e($employee->address); ?>" class="w-full border p-2 rounded"
                placeholder="Địa chỉ">
        </div>
        <div class="mb-4">
            <label>Tên đường</label>
            <input type="text" name="street" value="<?php echo e($employee->street); ?>" class="w-full border p-2 rounded"
                placeholder="Tên đường">
        </div>
        <div class="mb-4">
            <label>Phường</label>
            <input type="text" name="ward" value="<?php echo e($employee->ward); ?>" class="w-full border p-2 rounded"
                placeholder="Phường">
        </div>
        <div class="mb-4">
            <label>Tỉnh / Thành phố</label>
            <input type="text" name="province" value="<?php echo e($employee->province); ?>" class="w-full border p-2 rounded"
                placeholder="Tỉnh / Thành phố">
        </div>
        <div class="mb-4">
            <label>Ngày vào làm</label>
            <input type="date" name="hire_date" value="<?php echo e($employee->hire_date); ?>" class="w-full border p-2 rounded">
            <?php $__errorArgs = ['hire_date'];
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
            <label>Trạng thái</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="working" <?php echo e($employee->status == 'working' ? 'selected' : ''); ?>>Đang làm</option>
                <option value="resigned" <?php echo e($employee->status == 'resigned' ? 'selected' : ''); ?>>Đã nghỉ</option>
            </select>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" title="Cập nhật">Cập nhật</button>
    </form>
</body>

</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/employees/edit.blade.php ENDPATH**/ ?>
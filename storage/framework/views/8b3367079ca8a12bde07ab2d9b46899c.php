<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Cập nhật thông tin tài khoản</title>
</head>

<body>
    <a href="/httt/accounts" class="btn btn-secondary">
        ← Quay lại
    </a>
    <h1 class="text-2xl font-bold mb-6">
        Cập nhật thông tin tài khoản
    </h1>
    <form action="/httt/accounts/update/<?php echo e($user->id); ?>" method="POST" class="bg-white p-6 rounded shadow w-1/2">
        <?php echo csrf_field(); ?>
        <?php $__errorArgs = ['name'];
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
        <div class="mb-4">
            <label>Họ tên</label>
            <input type="text" name="name" value="<?php echo e($user->name); ?>" class="w-full border p-2 rounded"
                placeholder="Họ tên">
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo e($user->email); ?>" class="w-full border p-2 rounded"
                placeholder="Email">
        </div>
        <!-- <div class="mb-4">
            <label>Quyền</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="1" <?php if($user->role_id=='1'): ?> selected <?php endif; ?>
                    >Admin</option>
                <option value="2" <?php if($user->role_id=='2'): ?> selected <?php endif; ?>
                    >Phòng hành chính nhân sự</option>
                <option value="3" <?php if($user->role_id=='3'): ?> selected <?php endif; ?>
                    >Phòng quản lý chất lượng</option>
                <option value="4" <?php if($user->role_id=='4'): ?> selected <?php endif; ?>
                    >Phòng hệ thống thông tin</option>
                <option value="5" <?php if($user->role_id=='5'): ?> selected <?php endif; ?>
                    >Nhân viên</option>
            </select>
        </div> -->
        <div class="mb-4">
            <label>Quyền</label>
            <select name="role" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($r->id); ?>" <?php echo e($user->role_id == $r->id ? 'selected' : ''); ?>>
                    <?php echo e($r->description); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-4">
            <label>Trạng thái</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="active" <?php if($user->status == 'active'): ?> selected <?php endif; ?>
                    >Đang hoạt động</option>
                <option value="suspend" <?php if($user->status == 'suspend'): ?> selected <?php endif; ?>
                    >Tạm dừng</option>
            </select>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Cập nhật
        </button>
    </form>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/httt/accounts/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Quản lý tài khoản'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Thêm tài khoản</title>
</head>

<body>
    <a href="/httt/accounts/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Thêm tài khoản
    </a>
    <a href="/httt/accounts/export" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
        Xuất file Excel
    </a>
    <form method="GET" action="/httt/accounts" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="<?php echo e($search); ?>" class="border p-2"
            placeholder="Tìm theo họ tên, email, quyền hoặc trạng thái" style="width:400px;">
        <button class="bg-gray-500 text-white px-3 py-2 rounded">Tìm</button>
    </form>
    <?php if(session('success')): ?>
    <div class="bg-green-200 text-green-800 p-3 rounded mt-4">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">STT</th>
                    <th class="p-3">Họ tên</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Quyền</th>
                    <th class="p-3">Trạng thái</th>
                    <th class="p-3">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($u->id); ?></td>
                    <td class="p-3"><?php echo e($u->name); ?></td>
                    <td class="p-3"><?php echo e($u->email); ?></td>
                    <td class="p-3">
                        <?php if($u->role_id == '1'): ?>
                        Ban giám đốc
                        <?php endif; ?>
                        <?php if($u->role_id == '2'): ?>
                        Phòng hành chính nhân sự
                        <?php endif; ?>
                        <?php if($u->role_id == '3'): ?>
                        Phòng quản lý chất lượng
                        <?php endif; ?>
                        <?php if($u->role_id == '4'): ?>
                        Phòng hệ thống thông tin
                        <?php endif; ?>
                        <?php if($u->role_id == '5'): ?>
                        Nhân viên
                        <?php endif; ?>
                    </td>
                    <td class="p-3">
                        <?php if($u->status == 'active'): ?>
                        <span class="bg-green-200 text-green-700 px-2 py-1 rounded text-sm">
                            Đang hoạt động
                        </span>
                        <?php elseif($u->status == 'suspend'): ?>
                        <span class="bg-red-200 text-red-700 px-2 py-1 rounded text-sm">
                            Tạm dừng
                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="p-3 space-x-2">
                        <a href="/httt/accounts/edit/<?php echo e($u->id); ?>"
                            class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Sửa
                        </a>
                        <a href="/httt/accounts/delete/<?php echo e($u->id); ?>" class="bg-red-600 text-white px-3 py-1 rounded"
                            onclick="return confirm('Bạn có muốn xoá tài khoản này ?')">
                            Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/httt/accounts/index.blade.php ENDPATH**/ ?>
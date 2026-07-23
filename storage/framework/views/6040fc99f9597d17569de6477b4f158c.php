<?php $__env->startSection('title', 'Quản lý chấm công'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý chấm công</title>
</head>

<body>
    <div class="max-w-6xl mx-auto mt-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Danh sách chấm công nhân viên</h2>
        </div>

        <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3">Nhân viên</th>
                        <th class="p-3">Ngày</th>
                        <th class="p-3">Giờ vào</th>
                        <th class="p-3">Giờ ra</th>
                        <th class="p-3">Trạng thái</th>
                        <th class="p-3">Xác nhận</th>
                        <th class="p-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $atd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="p-3">
                            <p class="font-bold text-gray-800"><?php echo e($atd->name ?? 'N/A'); ?></p>
                            <p class="text-xs text-gray-500">Mã nhân viên: <?php echo e($atd->employee_code); ?></p>
                        </td>
                        <td class="p-3"><?php echo e($atd->work_date ? date('d/m/Y', strtotime($atd->work_date)) : ''); ?></td>
                        <td class="p-3 font-medium"><?php echo e($atd->check_in ?? 'Chưa có dữ liệu'); ?></td>
                        <td class="p-3 font-medium"><?php echo e($atd->check_out ?? 'Chưa có dữ liệu'); ?></td>
                        <td class="p-3">
                            <span
                                class="px-2 py-1 rounded text-xs <?php echo e($atd->status == 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                <?php if($atd->status == 'present'): ?>
                                Đúng giờ
                                <?php endif; ?>
                                <?php if($atd->status == 'late'): ?>
                                Đi trễ
                                <?php endif; ?>
                                <?php if($atd->status == 'absent'): ?>
                                Vắng mặt
                                <?php endif; ?>
                            </span>
                        </td>
                        <td class="p-3"><?php echo e($atd->confirm == 'yes' ? 'Đã xác nhận' : 'Chưa xác nhận'); ?></td>
                        <td class="p-3 text-center">
                            <div class="flex space-x-2">
                                <a href="/qlcl/attendances/edit/<?php echo e($atd->id); ?>"
                                    class="text-yellow-600 hover:underline" title="Sửa">Sửa</a>
                                <a href="/qlcl/attendances/delete/<?php echo e($atd->id); ?>" class="text-red-500 hover:underline"
                                    onclick="return confirm('Bạn có muốn xóa bảng chấm công này?')" title="Xoá">Xoá</a>
                                <?php if($atd->confirm == 'no'): ?>
                                <form action="/qlcl/attendances/confirm/<?php echo e($atd->id); ?>" method="post" onsubmit="return confirm('Bạn có muốn xác nhận bảng chấm công này?')">
                                    <?php echo csrf_field(); ?>
                                    <button class="text-blue-600 hover:underline" title="Xác nhận">Xác nhận</button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="hover:bg-gray-50 border-b">
                        <td colspan="7" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/qlcl/attendances/index.blade.php ENDPATH**/ ?>
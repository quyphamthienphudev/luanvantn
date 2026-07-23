<?php $__env->startSection('title', 'Quản lý lương'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý lương</title>
</head>

<body>
    <div class="bg-white rounded-lg shadow p-6">
        <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>
        <div class="mb-6 flex justify-between items-center">
            <form method="GET" action="/hcns/payrolls" class="flex gap-2">
                <select name="month" class="border rounded px-3 py-2">
                    <?php for($i = 1; $i <= 12; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($month == $i ? 'selected' : ''); ?>>Tháng <?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
                <select name="year" class="border rounded px-3 py-2">
                    <?php for($i = 2001; $i <= 2099; $i++): ?> <option value="<?php echo e($i); ?>" <?php echo e($year == $i ? 'selected' : ''); ?>>Năm <?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" title="Xem bảng lương">Xem bảng lương</button>
            </form>
            <div class="flex gap-2">
                <a href="/hcns/payrolls/create" class="bg-green-500 text-white px-4 py-2 rounded" title="+ Tạo">+ Tạo</a>
                <a href="/hcns/payrolls/export" class="bg-yellow-500 text-white px-4 py-2 rounded" title="Xuất Excel">Xuất Excel</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">STT</th>
                        <th class="border px-4 py-2">Mã nhân viên</th>
                        <th class="border px-4 py-2">Họ tên</th>
                        <th class="border px-4 py-2">Phòng ban</th>
                        <th class="border px-4 py-2">Chức vụ</th>
                        <th class="border px-4 py-2">Lương cơ bản</th>
                        <th class="border px-4 py-2">Phụ cấp</th>
                        <th class="border px-4 py-2">Thưởng</th>
                        <th class="border px-4 py-2">Khấu trừ</th>
                        <th class="border px-4 py-2">Thuế thu nhập cá nhân</th>
                        <th class="border px-4 py-2">Lương thực lãnh</th>
                        <th class="border px-4 py-2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="border px-4 py-2 text-center"><?php echo e($index + 1); ?></td>
                        <td class="border px-4 py-2"><?php echo e($p->employee_code ?? 'N/A'); ?></td>
                        <td class="border px-4 py-2"><?php echo e($p->full_name ?? 'N/A'); ?></td>
                        <td class="border px-4 py-2"><?php echo e($p->department_name ?? 'N/A'); ?></td>
                        <td class="border px-4 py-2"><?php echo e($p->position_name ?? 'N/A'); ?></td>
                        <td class="border px-4 py-2 text-right"><?php echo e(number_format($p->base_salary ?? 0)); ?> VNĐ</td>
                        <td class="border px-4 py-2 text-right"><?php echo e(number_format($p->allowance ?? 0)); ?> VNĐ</td>
                        <td class="border px-4 py-2 text-right"><?php echo e(number_format($p->bonus ?? 0)); ?> VNĐ</td>
                        <td class="border px-4 py-2 text-right"><?php echo e(number_format($p->deduction ?? 0)); ?> VNĐ</td>
                        <td class="border px-4 py-2 text-right"><?php echo e(number_format(($p->base_salary + $p->allowance + $p->bonus - $p->deduction) * 0.1 ?? 0)); ?> VNĐ</td>
                        <td class="border px-4 py-2 text-right font-bold"><?php echo e(number_format($p->total_salary ?? 0)); ?> VNĐ</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="/hcns/payrolls/<?php echo e($p->id); ?>" class="text-blue-500" title="Xem">Xem</a>
                            <a href="/hcns/payrolls/edit/<?php echo e($p->id); ?>" class="text-yellow-500 ml-2" title="Sửa">Sửa</a>
                            <form action="/hcns/payrolls/delete/<?php echo e($p->id); ?>" method="POST" class="inline ml-2">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="text-red-500"
                                    onclick="return confirm('Bạn có muốn xóa bảng lương này ?')" title="Xoá">Xoá</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="11" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\LVTN copy\resources\views/hcns/payrolls/index.blade.php ENDPATH**/ ?>
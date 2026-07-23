<?php $__env->startSection('title','Tra cứu thông tin chi tiết nhân viên'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Tra cứu thông tin chi tiết nhân viên</title>
</head>

<body>
    <a href="/hcns/employees" title="← Quay lại">← Quay lại</a>
    <div class="container mt-4">
        <h1 class="text-2xl font-bold mb-6">
            Chọn nhân viên để tra cứu
        </h1>
        <form action="/hcns/employees/detail" method="get" class="bg-white p-6 rounded shadow w-1/2">

            <div class="mb-4">
            <label>Nhân viên</label>
            <select name="employee_full_name" class="w-full border p-2 rounded">
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($e->full_name); ?>"><?php echo e($e->full_name); ?> - <?php echo e($e->employee_code); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            </div>

            <!-- Button -->
            <button name="detail"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" title="Tra cứu">
                Tra cứu
            </button>

        </form>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Danh sách chấm công chi tiết
        </h1>
        <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Mã nhân viên</th>
                    <th class="p-3">Tên nhân viên</th>
                    <th class="p-3">Ngày làm việc</th>
                    <th class="p-3">Giờ vào</th>
                    <th class="p-3">Giờ ra</th>
                    <th class="p-3">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($a->employee_code); ?></td>
                    <td class="p-3"><?php echo e($a->name); ?></td>
                    <td class="p-3"><?php echo e($a->work_date ? date('d/m/Y', strtotime($a->work_date)) : ''); ?></td>
                    <td class="p-3"><?php echo e($a->check_in); ?></td>
                    <td class="p-3"><?php echo e($a->check_out); ?></td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs <?php echo e($a->status == 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                            <?php if($a->status == 'present'): ?>
                            Đúng giờ
                            <?php endif; ?>
                            <?php if($a->status == 'late'): ?>
                            Đi trễ
                            <?php endif; ?>
                            <?php if($a->status == 'absent'): ?>
                            Vắng mặt
                            <?php endif; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="border-b">
                    <td colspan="6" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Danh sách khen thưởng
        </h1>
        <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Mã nhân viên</th>
                    <th class="p-3">Tên nhân viên</th>
                    <th class="p-3">Nội dung khen thưởng</th>
                    <th class="p-3">Số tiền</th>
                    <th class="p-3">Ngày ra quyết định</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($r->employee_code); ?></td>
                    <td class="p-3"><?php echo e($r->full_name); ?></td>
                    <td class="p-3"><?php echo e($r->title); ?></td>
                    <td class="p-3"><?php echo e($r->amount); ?></td>
                    <td class="p-3"><?php echo e($r->decision_date ? date('d/m/Y', strtotime($r->decision_date)) : ''); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="border-b">
                    <td colspan="5" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
        <br>
        <h1 class="text-2xl font-bold mb-6">
            Danh sách kỷ luật
        </h1>
        <div class="bg-white shadow rounded mt-6">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Mã nhân viên</th>
                    <th class="p-3">Tên nhân viên</th>
                    <th class="p-3">Nội dung kỷ luật</th>
                    <th class="p-3">Số tiền</th>
                    <th class="p-3">Ngày ra quyết định</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $disciplines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($d->employee_code); ?></td>
                    <td class="p-3"><?php echo e($d->full_name); ?></td>
                    <td class="p-3"><?php echo e($d->title); ?></td>
                    <td class="p-3"><?php echo e($d->amount); ?></td>
                    <td class="p-3"><?php echo e($d->decision_date ? date('d/m/Y', strtotime($d->decision_date)) : ''); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="border-b">
                    <td colspan="5" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/employees/detail.blade.php ENDPATH**/ ?>
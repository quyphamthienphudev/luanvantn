<?php $__env->startSection('title', 'Quản lý lương'); ?>

<?php $__env->startSection('content'); ?>
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
        <?php if(Auth::user()->role->name === 'admin'): ?>
        <form method="GET" action="/admin/payrolls" class="flex gap-2">
            <select name="month" class="border rounded px-3 py-2">
                <?php for($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e($month == $i ? 'selected' : ''); ?>>Tháng <?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <select name="year" class="border rounded px-3 py-2">
                <?php for($i = 2020; $i <= date('Y')+1; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e($year == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Xem bảng lương</button>
        </form>
        <?php endif; ?>
        <?php if(Auth::user()->role->name === 'user'): ?>
        <form method="GET" action="/payrolls" class="flex gap-2">
            <select name="month" class="border rounded px-3 py-2">
                <?php for($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e($month == $i ? 'selected' : ''); ?>>Tháng <?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <select name="year" class="border rounded px-3 py-2">
                <?php for($i = 2020; $i <= date('Y')+1; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e($year == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Xem bảng lương</button>
        </form>
        <?php endif; ?>
        <div class="flex gap-2">
            <?php if(Auth::user()->role->name === 'admin'): ?>
                <a href="/admin/payrolls/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Tạo</a>
                <a href="/admin/payrolls/export" class="bg-yellow-500 text-white px-4 py-2 rounded">Xuất Excel</a>
            <?php else: ?>
                <a href="/payrolls/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Tạo</a>
            <?php endif; ?>
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
                    <th class="border px-4 py-2">Thưởng</th>
                    <th class="border px-4 py-2">Khấu trừ</th>
                    <th class="border px-4 py-2">Tổng lương</th>
                    <th class="border px-4 py-2">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="border px-4 py-2 text-center"><?php echo e($index + 1); ?></td>
                    <td class="border px-4 py-2"><?php echo e($payroll->employee_code ?? 'N/A'); ?></td>
                    <td class="border px-4 py-2"><?php echo e($payroll->full_name ?? 'N/A'); ?></td>
                    <td class="border px-4 py-2"><?php echo e($payroll->department_name ?? 'N/A'); ?></td>
                    <td class="border px-4 py-2"><?php echo e($payroll->position_name ?? 'N/A'); ?></td>
                    <td class="border px-4 py-2 text-right"><?php echo e(number_format($payroll->base_salary ?? 0)); ?> VNĐ</td>
                    <td class="border px-4 py-2 text-right"><?php echo e(number_format($payroll->bonus ?? 0)); ?> VNĐ</td>
                    <td class="border px-4 py-2 text-right"><?php echo e(number_format($payroll->deduction ?? 0)); ?> VNĐ</td>
                    <td class="border px-4 py-2 text-right font-bold"><?php echo e(number_format($payroll->total_salary ?? 0)); ?> VNĐ</td>
                    <td class="border px-4 py-2 text-center">
                        <?php if(Auth::user()->role->name === 'admin'): ?>
                            <a href="/admin/payrolls/<?php echo e($payroll->id); ?>" class="text-blue-500">Xem</a>
                            <a href="/admin/payrolls/edit/<?php echo e($payroll->id); ?>" class="text-yellow-500 ml-2">Sửa</a>
                            <form action="/admin/payrolls/delete/<?php echo e($payroll->id); ?>" method="POST" class="inline ml-2">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="text-red-500" onclick="return confirm('Bạn có muốn xóa bảng lương này ?')">Xóa</button>
                            </form>
                        <?php else: ?>
                            <a href="/payrolls/<?php echo e($payroll->id); ?>" class="text-blue-500">Xem</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" class="text-center">Chưa có dữ liệu</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/payrolls/index.blade.php ENDPATH**/ ?>
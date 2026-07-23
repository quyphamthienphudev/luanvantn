<?php $__env->startSection('title','Quản lý hợp đồng lao động'); ?>

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý hợp đồng lao động</title>
</head>

<body>
    <a href="/hcns/contracts/create" class="bg-blue-600 text-white px-4 py-2 rounded" title="Thêm hợp đồng lao động">
        Thêm hợp đồng lao động
    </a>
    <form action="/hcns/contracts" method="get" class="mt-4">
        Tìm kiếm: <input type="text" name="search" value="<?php echo e($search); ?>" class="border p-2"
            placeholder="Tìm theo mã hợp đồng hoặc nhân viên" style="width:300px;">
        <button class="bg-gray-500 text-white px-3 py-2 rounded" title="Tìm">Tìm</button>
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
                    <th class="p-3">Mã hợp đồng</th>
                    <th class="p-3">Nhân viên</th>
                    <th class="p-3">Loại hợp đồng</th>
                    <th class="p-3">Ngày bắt đầu</th>
                    <th class="p-3">Ngày kết thúc</th>
                    <th class="p-3">Trạng thái</th>
                    <th class="p-3">Gia hạn</th>
                    <th class="p-3">Thanh lý</th>
                    <th class="p-3">Xem hợp đồng</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b">
                    <td class="p-3"><?php echo e($c->contract_code); ?></td>
                    <td class="p-3"><?php echo e($c->employee->full_name); ?></td>
                    <td class="p-3">
                        <?php if($c->contract_type == 'probation'): ?>
                        Hợp đồng thử việc
                        <?php endif; ?>
                        <?php if($c->contract_type == 'fixed_term'): ?>
                        Hợp đồng xác định thời hạn
                        <?php endif; ?>
                        <?php if($c->contract_type == 'indefinite'): ?>
                        Hợp đồng không xác định thời hạn
                        <?php endif; ?>
                    </td>
                    <td class="p-3">
                        <?php echo e($c->start_date ? date('d/m/Y', strtotime($c->start_date)) : ''); ?>

                    </td>
                    <td class="p-3">
                        <?php echo e($c->end_date ? date('d/m/Y', strtotime($c->end_date)) : 'Không có'); ?>

                    </td>
                    <td class="p-3">
                        <?php if($c->status == 'active'): ?>
                        Còn hạn
                        <?php endif; ?>
                        <?php if($c->status == 'expired'): ?>
                        Đã hết hạn
                        <?php endif; ?>
                        <?php if($c->status == 'terminated'): ?>
                        Đã thanh lý
                        <?php endif; ?>
                    </td>
                    <td class="p-3">
                        <b><a href="/hcns/contracts/edit/<?php echo e($c->id); ?>" style="color:blue;" title="Gia hạn">Gia hạn</a></b>
                    </td>
                    <td class="p-3">
                        <form action="/hcns/contracts/terminate/<?php echo e($c->id); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button style="color:red;" title="Thanh lý"><b>Thanh lý</b></button>
                        </form>
                    </td>
                    <td class="p-3">
                        <?php if($c->contract_file): ?>
                        <a href="/hcns/contracts/view/<?php echo e($c->id); ?>" class="bg-green-600 text-white px-3 py-1 rounded" title="Xem" target="_blank">Xem</a>
                        <?php else: ?>
                        <a href="" class="bg-green-600 text-white px-3 py-1 rounded" onclick="return alert('File không tồn tại')" title="Xem">Xem</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr class="border-b">
                    <td colspan="8" class="text-center py-10 text-gray-500">Không có dữ liệu</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/hcns/contracts/index.blade.php ENDPATH**/ ?>
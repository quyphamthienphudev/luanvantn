<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý nhân sự - Quản lý chấm công</title>
</head>

<body>
    <div class="max-w-md mx-auto mt-4 px-4">
        <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Chấm công vào làm</h2>
        </div>

        <?php if(!$attendance || !$attendance->check_in): ?>
        <form action="/attendances/checkin" method="post">
            <?php echo csrf_field(); ?>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-4 rounded-lg text-lg font-semibold hover:bg-blue-700" title="Xác nhận chấm công">
                Xác nhận chấm công
            </button>
        </form>
        <?php else: ?>
        <span class="block w-full text-center bg-green-600 text-white py-4 rounded-lg text-lg font-semibold">
            Đã xác nhận
        </span>
        <?php endif; ?>

        <br><br>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Chấm công tan ca</h2>
        </div>

        <?php if($attendance && !$attendance->check_out): ?>
        <form action="/attendances/checkout" method="post">
            <?php echo csrf_field(); ?>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-4 rounded-lg text-lg font-semibold hover:bg-blue-700" title="Xác nhận chấm công">
                Xác nhận chấm công
            </button>
        </form>
        <?php elseif($attendance && $attendance->check_out): ?>
        <span class="block w-full text-center bg-green-600 text-white py-4 rounded-lg text-lg font-semibold">
            Đã xác nhận
        </span>
        <?php else: ?>
        <span class="text-red-600">
            Vui lòng chấm công vào làm trước
        </span>
        <?php endif; ?>
    </div>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\PROJECT-2026\resources\views/user/attendances/index.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tuần 3</title>
</head>

<body>
    <h3>Chi tiết user</h3>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($u->id); ?></td>
            <td><?php echo e($u->name); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <a href="/users">Quay lại</a>
</body>

</html><?php /**PATH C:\Users\quy\Desktop\luanvantn\resources\views/users/show.blade.php ENDPATH**/ ?>
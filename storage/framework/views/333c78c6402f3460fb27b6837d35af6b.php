<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tuần 3</title>
</head>

<body>
    <form method="GET" action="/users">
    <?php echo csrf_field(); ?>
        <h4>Tìm kiếm</h4>
        <input type="text" name="search" value="<?php echo e($search); ?>"
            placeholder="Tìm theo id hoặc theo tên">
        <select name="sort">
            <option value="id">Sắp xếp theo ID</option>
            <option value="name">Sắp xếp theo tên</option>
        </select>
        <button>Tìm kiếm</button>
    </form>
    <h4>Thêm user</h4>
    <form method="POST" action="/users/add">
    <?php echo csrf_field(); ?>
        <input type="text" name="id" placeholder="ID">
        <input type="text" name="name" placeholder="Tên">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="phone" placeholder="Điện thoại">
        <button>Thêm</button>
    </form>
    <br>
    <!-- success -->
    <?php if(session('success')): ?>
        <?php echo e(session('success')); ?>

    <?php endif; ?>
    <!-- error -->
    <?php if(session('error')): ?>
        <?php echo e(session('error')); ?>

    <?php endif; ?>
    <!--  -->
    <br>
    <br>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Hành động</td>
        </tr>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <?php echo e($u->id); ?>

            </td>
            <form method="POST" action="/users/update/<?php echo e($u->id); ?>">
            <?php echo csrf_field(); ?>
            <td>
                <input type="text" name="name" value="<?php echo e($u->name); ?>">
            </td>
            <td>
                <input type="text" name="email" value="<?php echo e($u->email); ?>">
            </td>
            <td>
                <input type="text" name="phone" value="<?php echo e($u->phone); ?>">
            </td>
            <td>
                <button>Cập nhật</button>
                </form>
                <a href="/users/delete/<?php echo e($u->id); ?>">
                    Xóa
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</body>

</html><?php /**PATH C:\Users\quy\Desktop\luanvantn\resources\views/users/index.blade.php ENDPATH**/ ?>
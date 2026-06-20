<?php $__env->startSection('title','Danh sách phòng ban'); ?>

<?php $__env->startSection('content'); ?>

<?php if(auth()->user()->role->name=='admin'): ?>
<a href="/admin/departments/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Thêm phòng ban</a>
<?php endif; ?>

<?php if(session('success')): ?>
<div class="bg-green-200 text-green-800 p-3 rounded mt-4">
<?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="bg-red-200 text-black-800 p-3 rounded mt-4">
<?php echo e(session('error')); ?>

</div>
<?php endif; ?>
<?php if(auth()->user()->role->name=='admin'): ?>
<div class="bg-white shadow rounded mt-6">
<table class="w-full text-left">
<thead class="bg-gray-200">
<tr>
<th class="p-3">Tên phòng ban</th>
<th class="p-3">Mô tả thông tin</th>
<th class="p-3">Hành động</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="border-b">
<td class="p-3"><?php echo e($d->name); ?></td>
<td class="p-3"><?php echo e($d->description); ?></td>
<td class="p-3 space-x-2">
<a href="/admin/departments/edit/<?php echo e($d->id); ?>" class="bg-yellow-500 text-white px-3 py-1 rounded">Sửa</a>
<a href="/admin/departments/delete/<?php echo e($d->id); ?>" class="bg-red-600 text-white px-3 py-1 rounded"
onclick="return confirm('Bạn có muốn xoá phòng ban này ?')">Xóa</a>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>

<?php if(auth()->user()->role->name=='user'): ?>
<div class="bg-white shadow rounded mt-6">
<table class="w-full text-left">
<thead class="bg-gray-200">
<tr>
<th class="p-3">Tên phòng ban</th>
<th class="p-3">Mô tả thông tin</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="border-b">
<td class="p-3"><?php echo e($d->name); ?></td>
<td class="p-3"><?php echo e($d->description); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\quy\Desktop\project2026\resources\views/departments/index.blade.php ENDPATH**/ ?>
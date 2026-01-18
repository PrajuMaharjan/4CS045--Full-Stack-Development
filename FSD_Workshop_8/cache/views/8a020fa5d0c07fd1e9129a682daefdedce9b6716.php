
<?php $__env->startSection('content'); ?>
<h2>Students</h2>
<a href="index.php?php?page=create">Add Student</a>
<table>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>course</th>
		<th>Actions</th>
	</tr>
	<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td><?php echo e($student->name); ?></td>
		<td><?php echo e($student->email); ?></td>
		<td><?php echo e($student->course); ?></td>
		<td>
			<a href="index.php?page=edit&id=<?php echo e($student->id); ?>">Edit</a>
			<a href="index.php?page=delete&id=<?php echo e($student->id); ?>">Delete</a>
		</td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FSD_Workshop_8\app\views/students/index.blade.php ENDPATH**/ ?>
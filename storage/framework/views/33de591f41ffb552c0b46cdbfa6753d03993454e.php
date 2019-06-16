

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Tevékenységeim</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<table class="table table-striped table-hover">
		<thead class="thead">
			<tr>
				<td>Dátum</td>
				<td>Terület</td>
				<td>Tevékenység</td>
			</tr>
		</thead>
		<tbody>
			<?php $__empty_1 = true; foreach($activity_log as $log): $__empty_1 = false; ?>
			<tr>
				<td><?php echo e($log->created_at); ?></td>
				<td><?php echo e($log->log_name); ?></td>
				<td><?php echo e($log->description); ?></td>
			</tr>
			<?php endforeach; if ($__empty_1): ?>
			<tr>
				<td colspan="6">Nincs rendelkezésre álló adat!</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<div style="text-align: center"><?php echo e($activity_log->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
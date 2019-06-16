

<?php $__env->startSection('background'); ?>
	<div class="login-background"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
	<div class="container">
		<section class="registration-box">
			<div class="panel panel-default">
				<div class="panel-heading">Leiratkozás</div>
				<div class="panel-body">
					<form action="" method="post">
						<input type="text" name="email" class="form-control" placeholder="Regisztrált e-mail címed">

						<?php echo e(csrf_field()); ?>

						<input type="submit" class="btn btn-warning btn-lg" value="Leiratkozás">					
					</form>
				</div>
			</div>
		</section>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
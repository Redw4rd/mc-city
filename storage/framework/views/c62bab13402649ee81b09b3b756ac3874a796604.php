
<?php $__env->startSection('background'); ?>
	<div class="login-background"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
	<div class="container">
		<div class="row">
			<section class="login-box">
				<div class="panel panel-default">
					<div class="panel-heading">Bejelentkezés</div>
					<div class="panel-body">
						<form action="" method="post">
							<input type="text" name="email" class="form-control" placeholder="E-mail cím" required autocomplete="off">
							<input type="password" name="password" class="form-control" placeholder="Jelszó" required>

							<?php echo e(csrf_field()); ?>

							<input type="submit" class="btn btn-primary btn-lg" value="Bejelentkezés">
							<div class="row">
								<div class="col-md-4">
									<a href="<?php echo e(route('registration')); ?>" class="login-registration-text">Regisztráció</a>
								</div>
								<div class="col-md-8">
									<a href="<?php echo e(route('lost-password')); ?>" class="login-lostpass-text">Elfelejtetted a jelszavadat?</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
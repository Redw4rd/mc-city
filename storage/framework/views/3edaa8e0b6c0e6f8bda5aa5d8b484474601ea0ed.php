

<?php $__env->startSection('background'); ?>
	<div class="login-background"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
	<div class="container">
		<section class="registration-box">
			<div class="panel panel-default">
				<div class="panel-heading">Elfelejtettem a jelszavam</div>
				<div class="panel-body">
				<?php if($errors->all()): ?>
				<div class="alert alert-warning">
				<button type="button" 
                    class="close" 
                    data-dismiss="alert" 
                    aria-hidden="true">&times;</button>
				<?php foreach($errors->all() as $error): ?>
					<?php echo e($error); ?> <br>
				<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<?php if($withcode): ?>
					<form action="" method="post">
						<input type="password" name="password" class="form-control" placeholder="Új jelszó">
						<input type="password" name="password_re" class="form-control" placeholder="Új jelszó megerősítése">
						<input type="hidden" name="_password_reset" value="<?php echo e($withcode); ?>">

						<?php echo e(csrf_field()); ?>

						<input type="submit" class="btn btn-warning btn-lg" value="Jelszó módosítás">
					</form>
				<?php else: ?>
					<form action="" method="post">
						<div class="alert alert-info">
							Az elfelejtett jelszó funkció segítségével, visszaszerezheted felhasználói fiókod. Az általad megadott e-mail címre kiküldünk egy azonosító kódot, melyet megadva megtudod változtatni jelszavad! <strong>(A megerősítő kódot csak egyszer használhatod!)</strong>
						</div>

						<input type="text" name="email" class="form-control" placeholder="Regisztrált e-mail címed">

						<?php echo e(csrf_field()); ?>

						<div class="row">
							<div class="col-sm-6">
								<?php echo \Recaptcha::render(); ?>

							</div>
							<div class="col-sm-6">
								<input type="submit" class="btn btn-warning btn-lg" value="E-mail kiküldése">
							</div>
						</div>						
					</form>
				<?php endif; ?>
				</div>
			</div>
		</section>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
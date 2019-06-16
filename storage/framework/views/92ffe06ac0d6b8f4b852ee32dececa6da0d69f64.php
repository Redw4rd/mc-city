
<?php $__env->startSection('background'); ?>
	<div class="login-background"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
	<div class="container">
		<div class="row">
			<section class="registration-box">
				<div class="panel panel-default">
					<div class="panel-heading">Regisztráció</div>
					<div class="panel-body">
						<form action="" method="post">
							<div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
								<label for="username" class="control-label">Felhasználónév: </label>
								<input type="text" name="username" class="form-control" value="<?php echo e(old('username')); ?>">
								<?php if($errors->has('username')): ?>
									<span class="help-block"><?php echo e($errors->first('username')); ?></span>
								<?php endif; ?>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
										<label for="email" class="control-label">E-mail cím: </label>
										<input type="text" name="email" class="form-control" value="<?php echo e(old('email')); ?>">
										<?php if($errors->has('email')): ?>
											<span class="help-block"><?php echo e($errors->first('email')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group<?php echo e($errors->has('email_re') ? ' has-error' : ''); ?>">
										<label for="email_re" class="control-label">E-mail cím megerősítése: </label>
										<input type="text" name="email_re" class="form-control" value="">
										<?php if($errors->has('email_re')): ?>
											<span class="help-block"><?php echo e($errors->first('email_re')); ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
										<label for="password" class="control-label">Jelszó: </label>
										<input type="password" name="password" class="form-control" value="">
										<?php if($errors->has('password')): ?>
											<span class="help-block"><?php echo e($errors->first('password')); ?></span>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
										<label for="password_re" class="control-label">Jelszó megerősítése: </label>
										<input type="password" name="password_re" class="form-control" value="">
										<?php if($errors->has('password_re')): ?>
											<span class="help-block"><?php echo e($errors->first('password_re')); ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="checkbox">
								<div class="form-group<?php echo e($errors->has('over_13') ? ' has-error' : ''); ?>">
									<input type="checkbox" name="over_13">
									<span class="checkbox-text">Kijelentem, hogy 13 éves, vagy annál idősebb vagyok.</span>
									<?php if($errors->has('over_13')): ?>
										<span class="help-block"><?php echo e($errors->first('over_13')); ?></span>
									<?php endif; ?>
								</div>
							</div>
							<div class="checkbox">
								<div class="form-group<?php echo e($errors->has('aszf_accept') ? ' has-error' : ''); ?>">
									<input type="checkbox" name="aszf_accept">
									<span class="checkbox-text">Elfogadom az <a href="<?php echo e(route('site', 'aszf')); ?>">Általános Szerződési Feltételeket</a>, az <a href="<?php echo e(route('site', 'aff')); ?>">Általános Felhasználói Feltételeket</a>, illetve a <a href="<?php echo e(route('site', 'rules')); ?>">Szabályzatot</a>.</span>
									<?php if($errors->has('aszf_accept')): ?>
										<span class="help-block"><?php echo e($errors->first('aszf_accept')); ?></span>
									<?php endif; ?>
								</div>
							</div>
							<div class="checkbox">
								<div class="form-group">
									<input type="checkbox" name="newsletter" checked>
									<span class="checkbox-text">Szeretnék a jövőben a szerverrel kapcsolatos hírleveleket kapni.</span>
								</div>
							</div>
							<?php echo e(csrf_field()); ?>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
										<?php if($errors->has('g-recaptcha-response')): ?>
											<span class="help-block"><?php echo e($errors->first('g-recaptcha-response')); ?></span>
										<?php endif; ?>
										<?php echo \Recaptcha::render(); ?>

									</div>
								</div>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-lg" value="Regisztráció">
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
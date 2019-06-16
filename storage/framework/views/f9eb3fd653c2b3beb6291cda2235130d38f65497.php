

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Kapcsolat</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="container">
		<div class="row">
			<div id="kapcsolat">
				<div class="page-content">
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
					<form action="" method="post" class="contact-sendform">
						<div class="row">
							<div class="col-sm-6">
								<label for="name" class="full-width">Neved</label>
								<input type="text" name="name" class="form-control full-width" placeholder="Neved" value="<?php echo e(old('name')); ?>" required>
							</div>
							<div class="col-sm-6">
								<label for="email" class="full-width">E-mail címed</label>
								<input type="text" name="email" class="form-control full-width" value="<?php echo e(old('email')); ?>" placeholder="E-mail címed" required>
							</div>
							<div class="col-sm-12">
								<label for="type" class="full-width">E-mail tárgya</label>
								<select name="type" id="type" class="form-control full-width">
								<?php foreach($settings['types'] as $type): ?>
									<option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
								<?php endforeach; ?>
								</select>
							</div>
							<div class="col-sm-12">
								<textarea name="message" id="message" class="form-control" rows="10" style="max-width: 100%" placeholder="Üzeneted" required><?php echo e(old('message')); ?></textarea>
							</div>
							<div class="col-sm-12" style="margin: 10px 0">
								<?php echo \Recaptcha::render(); ?>

							</div>
							<div class="col-sm-12">
								<?php echo e(csrf_field()); ?>

								<button type="submit" style="margin-bottom: 10px" class="btn btn-primary btn-lg">Levélküldés</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
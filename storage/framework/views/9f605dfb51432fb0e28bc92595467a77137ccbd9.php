

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Profil</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Alap adatok</div>
					<div class="panel-body">
						<form action="" method="post">
							<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
								<label for="name" class="control-label">Neved: </label>
								<input type="text" name="name" class="form-control" value="<?php echo e(Auth::user()->name); ?>">
								<?php if($errors->has('name')): ?>
									<span class="help-block"><?php echo e($errors->first('name')); ?></span>
								<?php endif; ?>
							</div>

							<div class="form-group<?php echo e($errors->has('displayed_name') ? ' has-error' : ''); ?>">
								<label for="displayed_name" class="control-label">Megjelenítendő neved: </label>
								<select name="displayed_name" id="displayed_name" class="form-control">
									<option value="username" <?php if(Auth::user()->displayed_name == 'username'): ?> selected <?php endif; ?>>Felhasználónév</option>
									<option value="name" <?php if(Auth::user()->displayed_name == 'name'): ?> selected <?php endif; ?>>Teljes név</option>
								</select>
								<?php if($errors->has('displayed_name')): ?>
									<span class="help-block"><?php echo e($errors->first('displayed_name')); ?></span>
								<?php endif; ?>
							</div>

							<div class="form-group<?php echo e($errors->has('avatar_image') ? ' has-error' : ''); ?>">
								<label for="avatar_image" class="control-label">Megjelenő profilkép: </label>
								<select name="avatar_image" id="avatar_image" class="form-control">
									<option value="gravatar" <?php if(Auth::user()->avatar_image == 'gravatar'): ?> selected <?php endif; ?>>Gravatár</option>
									<option value="skin" <?php if(Auth::user()->avatar_image == 'skin'): ?> selected <?php endif; ?>>Skin</option>
								</select>
								<?php if($errors->has('avatar_image')): ?>
									<span class="help-block"><?php echo e($errors->first('avatar_image')); ?></span>
								<?php endif; ?>
							</div>

							<div class="form-group<?php echo e($errors->has('subscribe_newsletter') ? ' has-error' : ''); ?>">
								<label for="subscribe_newsletter" class="control-label">Hírlevél: </label>
								<select name="subscribe_newsletter" id="subscribe_newsletter" class="form-control">
									<option value="0" <?php if(Auth::user()->subscribe_newsletter == 0): ?> selected <?php endif; ?>>Leiratkozva</option>
									<option value="1" <?php if(Auth::user()->subscribe_newsletter == 1): ?> selected <?php endif; ?>>Feliratkozva</option>
								</select>
								<?php if($errors->has('subscribe_newsletter')): ?>
									<span class="help-block"><?php echo e($errors->first('subscribe_newsletter')); ?></span>
								<?php endif; ?>
							</div>

							<?php echo e(csrf_field()); ?>

							<button type="submit" class="btn btn-primary">Mentés</button>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-4 hidden-xs" style="position: absolute; bottom: 0; right: 0">
				<img src="images/endergirl_2.png" class="img-responsive" alt="Skeleton girl">
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_js'); ?>
	<script>
		$(function () {
			$('[data-toggle="popover"]').popover()
		})
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->startSection('pagetitle'); ?>
	Weboldal beállítások
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<form action="" method="post">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Oldal beállítások</div>
					<div class="panel-body">
						<div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
							<label for="title" class="control-label">Oldal neve: </label>
							<input type="text" name="title" class="form-control" value="<?php echo e($site['title']); ?>">
							<?php if($errors->has('title')): ?>
								<span class="help-block"><?php echo e($errors->first('title')); ?></span>
							<?php endif; ?>
						</div>

						<div class="form-group<?php echo e($errors->has('keywords') ? ' has-error' : ''); ?>">
							<label for="keywords" class="control-label">Kulcsszavak: </label>
							<input type="text" name="keywords" class="form-control" value="<?php echo e($site['keywords']); ?>">
							<?php if($errors->has('keywords')): ?>
								<span class="help-block"><?php echo e($errors->first('keywords')); ?></span>
							<?php endif; ?>
						</div>

						<div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
							<label for="description" class="control-label">Leírás: </label>
							<input type="text" name="description" class="form-control" value="<?php echo e($site['description']); ?>">
							<?php if($errors->has('title')): ?>
								<span class="help-block"><?php echo e($errors->first('description')); ?></span>
							<?php endif; ?>
						</div>				
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Közzösségi oldalak</div>
					<div class="panel-body">
						<div class="form-group<?php echo e($errors->has('social_facebook_link') ? ' has-error' : ''); ?>">
							<label for="social_facebook_link" class="control-label">Facebook oldal: </label>
							<input type="text" name="social_facebook_link" class="form-control" value="<?php echo e($site['social_facebook_link']); ?>">
							<?php if($errors->has('social_facebook_link')): ?>
								<span class="help-block"><?php echo e($errors->first('social_facebook_link')); ?></span>
							<?php endif; ?>
						</div>
						<div class="form-group<?php echo e($errors->has('social_youtube_link') ? ' has-error' : ''); ?>">
							<label for="social_youtube_link" class="control-label">Youtube csatorna: </label>
							<input type="text" name="social_youtube_link" class="form-control" value="<?php echo e($site['social_youtube_link']); ?>">
							<?php if($errors->has('social_youtube_link')): ?>
								<span class="help-block"><?php echo e($errors->first('social_youtube_link')); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php echo e(csrf_field()); ?>

		<div class="clearfix"></div>
		<button type="submit" class="btn btn-primary">Mentés</button>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
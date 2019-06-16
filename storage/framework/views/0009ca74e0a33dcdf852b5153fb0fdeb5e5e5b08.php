

<?php $__env->startSection('pagetitle'); ?>
	<?php echo e($user->username); ?> profilja
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="panel panel-default">
		<div class="panel-heading">Felhasználó adatai</div>
		<div class="panel-body">
			<form action="" method="post" name="updateUser">
				<div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
					<label for="username" class="control-label">Felhasználónév: </label>
					<input type="text" name="username" class="form-control" value="<?php echo e($user->username); ?>">
					<?php if($errors->has('username')): ?>
						<span class="help-block"><?php echo e($errors->first('username')); ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="name" class="control-label">Név: </label>
					<input type="text" name="name" class="form-control" value="<?php echo e($user->name); ?>">
					<?php if($errors->has('name')): ?>
						<span class="help-block"><?php echo e($errors->first('name')); ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
					<label for="email" class="control-label">E-mail cím: </label>
					<input type="text" name="email" class="form-control" value="<?php echo e($user->email); ?>">
					<?php if($errors->has('email')): ?>
						<span class="help-block"><?php echo e($errors->first('email')); ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('rank') ? ' has-error' : ''); ?>">
					<label for="rank" class="control-label">Rang: </label>
					<select name="rank" class="form-control" id="rank">
						<option value="0">Nincs</option>
						<?php foreach($ranks as $rank): ?>
						<option value="<?php echo e($rank->id); ?>" <?php if($user->rank_id == $rank->id): ?> selected <?php endif; ?>><?php echo e($rank->name); ?></option>
						<?php endforeach; ?>
					</select>
					<?php if($errors->has('rank')): ?>
						<span class="help-block"><?php echo e($errors->first('rank')); ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('is_admin') ? ' has-error' : ''); ?>">
					<label for="is_admin" class="control-label">Jogosultság: </label>
					<select name="is_admin" class="form-control" id="is_admin">
						<option value="0" <?php if(!$user->isAdmin()): ?> selected <?php endif; ?>>Felhasználó</option>
						<option value="1" <?php if($user->isAdmin()): ?> selected <?php endif; ?>>Adminisztrátor</option>
					</select>
					<?php if($errors->has('is_admin')): ?>
						<span class="help-block"><?php echo e($errors->first('is_admin')); ?></span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('wallet') ? ' has-error' : ''); ?>">
					<label for="wallet" class="control-label">Pénztárca egyenleg: </label>
					<input type="number" name="wallet" class="form-control" value="<?php echo e($user->wallet); ?>">
					<?php if($errors->has('wallet')): ?>
						<span class="help-block"><?php echo e($errors->first('wallet')); ?></span>
					<?php endif; ?>
				</div>

				<input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
				<?php echo e(method_field('PUT')); ?>

				<?php echo e(csrf_field()); ?>

			</form>
			<button type="submit" class="btn btn-primary pull-left" id="updateUser">Mentés</button>
			<?php if(!is_null($user->verify_token)): ?>
			<form action="<?php echo e(action('DashboardController@activateUser')); ?>" name="activateUser" method="post">
				<input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
				<input type="hidden" name="ACTIVATE" value="yes">
				<?php echo e(csrf_field()); ?>

			</form>
			<button type="submit" id="activateUser" class="btn btn-warning" style="margin-left: 20px">Felhasználó aktiválása</button>
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer_js'); ?>
	<script>
		$(document).ready(function() {
			$("#activateUser").on('click', function() {
				$("form[name='activateUser']").submit();
			});

			$("#updateUser").on('click', function() {
				$("form[name='updateUser']").submit();
			});
		});
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
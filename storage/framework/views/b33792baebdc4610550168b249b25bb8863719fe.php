

<?php $__env->startSection('pagetitle'); ?>
	Akciók
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<form action="" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading">PayPal</div>
			<div class="panel-body">
				<div class="form-group<?php echo e($errors->has('paypal_discount') ? ' has-error' : ''); ?>">
					<label for="paypal_discount" class="control-label">PayPal extra pont</label>
					<div class="input-group input-group-sm">
						<input type="text" name="paypal_discount" class="form-control" value="<?php echo e($site['paypal_discount']); ?>">
						<div class="input-group-addon">%</div>
					</div>
					<small id="emailHelp" class="form-text text-muted">Ennyi %-al kap több PixelPontot a vásárló, ha a PayPal fizetési módot választja</small>
					<?php if($errors->has('paypal_discount')): ?>
						<span class="help-block"><?php echo e($errors->first('paypal_discount')); ?></span>
					<?php endif; ?>
				</div>

				<div class="form-group<?php echo e($errors->has('paypal_min_amount') ? ' has-error' : ''); ?>">
					<label for="paypal_min_amount" class="control-label">Minimum PixelPont</label>
					<div class="input-group input-group-sm">
						<input type="text" name="paypal_min_amount" class="form-control" value="<?php echo e($site['paypal_min_amount']); ?>">
						<div class="input-group-addon">Pixel</div>
					</div>
					<small id="emailHelp" class="form-text text-muted">Ez a minimum PixelPont szám amit meg tudnak vásárolni</small>
					<?php if($errors->has('paypal_min_amount')): ?>
						<span class="help-block"><?php echo e($errors->first('paypal_min_amount')); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php echo e(csrf_field()); ?>

		<button type="submit" class="btn btn-primary">Mentés</button>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
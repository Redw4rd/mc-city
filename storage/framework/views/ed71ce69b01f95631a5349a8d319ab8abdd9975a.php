

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Térkép</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="container">
		<div class="row">
			<iframe src="http://s1.pixelhero.hu/dynmap/?username=<?php if(Auth::check()): ?><?php echo e(Auth::user()->getNameOrUsername()); ?><?php endif; ?>" width="100%" height="800">
				<p>Your browser does not support iframes.</p>
			</iframe>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
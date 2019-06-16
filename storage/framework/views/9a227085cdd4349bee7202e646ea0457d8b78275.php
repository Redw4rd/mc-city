

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>#<?php echo e($ticket->id); ?> Hibajegy megtekintése</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="container">
		<div class="row">
			<div class="well">
				<ul class="comments">
					<?php if(!$ticket->is_locked): ?>
					<li style="background-color: transparent; margin-bottom: 40px">
					<form action="" method="post">
						<div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
							<textarea name="message" id="message" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Ide írd további problémádat a beküldött hibajeggyel kapcsolatban"><?php echo e(old('message')); ?></textarea>
							<?php if($errors->has('message')): ?>
								<span class="help-block"><?php echo e($errors->first('message')); ?></span>
							<?php endif; ?>
						</div>
						<?php echo e(method_field('PUT')); ?>

						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
						<button type="submit" class="btn btn-primary btn-sm">Üzenet küldése</button>
					</form>
					</li>
					<li>
						<div class="comment-heading">
							<div class="pull-left">
								<strong><?php echo e($ticket->user->username); ?></strong>
							</div>
							<div class="pull-right">
								<small class="label label-default"><?php echo e($ticket->created_at); ?></small>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="comment-body">
							<?php echo e($ticket->message); ?>

						</div>
					</li>
					<?php endif; ?>
					<?php foreach($ticket->messages as $message): ?>
					<li>
						<div class="comment-heading">
							<div class="pull-left">
								<strong><?php echo e($message->userdata->username); ?></strong>
								<?php if($message->userdata->is_admin): ?>
									<small class="label label-primary">Ügyfélszolgálat</small>
								<?php endif; ?>
							</div>
							<div class="pull-right">
								<small class="label label-default"><?php echo e($message->created_at); ?></small>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="comment-body">
							<?php echo e($message->message); ?>

						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
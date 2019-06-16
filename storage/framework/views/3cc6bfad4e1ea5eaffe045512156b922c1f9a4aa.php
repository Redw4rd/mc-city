

<?php $__env->startPush('header_css'); ?>
	<style>
        ul.comments {
            padding: 0;
            list-style: none;
        }
        ul.comments li {
            margin: 20px 0;
            background-color: #eee
        }
        ul.comments li .comment-heading {
            background-color: #2c3e50;
            padding: 5px;

            font-size: 16px;
            color: #fff;
        }
        ul.comments li .comment-body {
            padding: 5px
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('pagetitle'); ?>
	#<?php echo e($ticket->id); ?> hibajegy
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="well">
		<div class="pull-right">
			<form action="" method="post">
				<input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
				<?php echo e(method_field('POST')); ?>

				<?php echo e(csrf_field()); ?>

				<button type="submit" class="btn btn-danger btn-xs" <?php if($ticket->is_locked): ?> disabled <?php endif; ?>><span class="fa fa-lock"></span> Hibajegy zárolása</button>
			</form>
			<div class="clearfix"></div>
		</div>
		<div style="margin-bottom: 30px"></div>
		<ul class="comments">
			<?php if(!$ticket->is_locked): ?>
			<li style="background-color: transparent; margin-bottom: 40px">
			<form action="" method="post">
				<div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
					<textarea name="message" id="message" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Megoldásnak vélt üzenet"><?php echo e(old('message')); ?></textarea>
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
		</ul>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
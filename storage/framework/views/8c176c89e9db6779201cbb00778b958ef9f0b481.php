

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Hibajegyek</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
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
	<button class="btn btn-primary" data-toggle="collapse" data-target="#add" style="float: right; margin: 10px 0"><i class="fa fa-plus"></i> Új hibajegy</button>
	<div class="clearfix"></div>
	<div class="panel panel-default collapse" id="add">
		<div class="panel-heading"><div class="panel-text">Hibajegy nyitás</div></div>
		<div class="panel-body">
			<form action="" method="POST">
				<label for="category">Kategória</label>
				<select name="category" class="form-control full-width" id="category">
				<?php foreach($settings['types'] as $type): ?>
				<option value="<?php echo e($type); ?>"><?php echo e($type); ?></option>
				<?php endforeach; ?>
				</select>

				<div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
					<label for="message">Fejtsd ki problémád</label>
					<textarea name="message" id="message" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%"><?php echo e(old('message')); ?></textarea>
					<?php if($errors->has('message')): ?>
						<span class="help-block"><?php echo e($errors->first('message')); ?></span>
					<?php endif; ?>
				</div>
				<?php echo e(csrf_field()); ?>

				<button class="btn btn-primary btn-lg" type="submit" style="margin: 20px 0">Hibajegy beküldése</button>
			</form>
		</div>
	</div>

	<table class="table table-striped table-hover">
		<thead class="thead">
			<tr>
				<td>#ID</td>
				<td>Kategória</td>
				<td></td>
				<td>Utolsó aktivitás</td>
				<td>Státusz</td>
				<td>Műveletek</td>
			</tr>
		</thead>
		<tbody>
			<?php $__empty_1 = true; foreach($tickets as $ticket): $__empty_1 = false; ?>
			<tr data-href="<?php echo e(route('tickets', $ticket->id)); ?>">
				<td><?php echo e($ticket->id); ?></td>
				<td><?php echo e($ticket->type); ?></td>
				<td><?php echo e(str_limit($ticket->message, 60)); ?></td>
				<td><?php echo e(date('Y, F d', strtotime($ticket->updated_at))); ?></td>
				<td>
				<?php if($ticket->is_locked): ?>
					<span class="label label-danger"><span class="fa fa-lock"></span> <span class="hidden-xs">Zárolva</span></span>
				<?php else: ?>
				<?php if($ticket->answered): ?>
					<span class="label label-success"><span class="fa fa-check"></span> <span class="hidden-xs">Megválaszolva</span></span>
				<?php else: ?>
					<span class="label label-warning"><span class="fa fa-eye-slash"></span> <span class="hidden-xs">Válaszra vár</span></span>
				<?php endif; ?>
				<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo e(route('tickets', $ticket->id)); ?>" class="btn btn-info btn-xs"><span class="fa fa-eye" title="Megtekintés"></span> <span class="hidden-xs">Megtekintés</span></a>
				</td>
			</tr>
			<?php endforeach; if ($__empty_1): ?>
			<tr>
				<td colspan="6">Nincs rendelkezésre álló adat!</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<div style="text-align: center"><?php echo e($tickets->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_js'); ?>
	<script>
		$('[data-href]').click(function() {
			window.document.location = $(this).data("href");
		}).addClass('link');
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
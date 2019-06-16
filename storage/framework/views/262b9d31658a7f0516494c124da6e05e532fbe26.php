

<?php $__env->startSection('pagetitle'); ?>
	<?php if($post != 'null'): ?>
		Rang szerkesztése
	<?php else: ?>
		Rang létrehozás
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('header_css'); ?>
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page'); ?>
	<form action="" method="post">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="name" class="control-label">Rang megnevezése: </label>
					<input type="text" name="name" class="form-control" value="<?php if($post != 'null'): ?><?php echo e($post->name); ?><?php else: ?><?php echo e(old('name')); ?><?php endif; ?>">
					<?php if($errors->has('name')): ?>
						<span class="help-block"><?php echo e($errors->first('name')); ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group<?php echo e($errors->has('group') ? ' has-error' : ''); ?>">
					<label for="group" class="control-label">Rang csoport: </label>
					<input type="text" name="group" class="form-control" value="<?php if($post != 'null'): ?><?php echo e($post->group); ?><?php else: ?><?php echo e(old('group')); ?><?php endif; ?>">
					<?php if($errors->has('group')): ?>
						<span class="help-block"><?php echo e($errors->first('group')); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
			<textarea name="description" id="description" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Rang leírása"><?php if($post != 'null'): ?> <?php echo $post->description; ?> <?php else: ?> <?php echo e(old('description')); ?> <?php endif; ?></textarea>
			<?php if($errors->has('description')): ?>
				<span class="help-block"><?php echo e($errors->first('description')); ?></span>
			<?php endif; ?>
		</div>

		<div class="form-group<?php echo e($errors->has('color') ? ' has-error' : ''); ?>">
			<label for="color" class="control-label">Szín: </label>
			<input type="text" name="color" id="color" class="form-control" value="<?php if($post != 'null'): ?><?php echo e($post->color); ?><?php else: ?><?php echo e(old('color')); ?><?php endif; ?>">
			<?php if($errors->has('color')): ?>
				<span class="help-block"><?php echo e($errors->first('color')); ?></span>
			<?php endif; ?>
		</div>

		<div class="form-group<?php echo e($errors->has('price') ? ' has-error' : ''); ?>">
				<label for="price" class="control-label">Rang ára: </label>
			<div class="input-group input-group-sm">
				<input type="text" name="price" class="form-control" value="<?php if($post != 'null'): ?><?php echo e($post->price); ?><?php else: ?><?php echo e(old('price')); ?><?php endif; ?>">
				<span class="input-group-addon">Pixel</span>
			</div>
			<?php if($errors->has('price')): ?>
				<span class="help-block"><?php echo e($errors->first('price')); ?></span>
			<?php endif; ?>
		</div>
		
		<?php if($post != 'null'): ?>
		<?php echo e(method_field('PUT')); ?>

		<?php endif; ?>
		<?php echo e(csrf_field()); ?>

		<div class="pull-left">
			<button type="submit" class="btn btn-primary">Rang mentése</button>
		</div>
	</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_js'); ?>
	<script type="text/javascript" src="<?php echo e(asset('js/colorpicker.js')); ?>"></script>
	<script src="js/tinymce/tinymce.min.js"></script>
	<script>
		$(document).ready(function() {
			tinymce.init({
				selector: 'textarea',
				language: 'hu_HU',
				height: 300,
				cleanup: true,
				verify_html: false,
				statusbar: false,
				browser_spellcheck: true,
				entity_encoding : "raw",
				plugins: [
					'advlist autolink lists link image charmap preview anchor',
					'searchreplace visualblocks code fullscreen',
					'insertdatetime media table contextmenu paste code textcolor'
				],
				menubar: 'edit insert view format table tools',
				toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
				content_css: [
					'css/bootstrap.min.css',
					'css/style.css'
				]
			});
		});

		$('input#color').ColorPicker({
			<?php if($post->color): ?>
			color: '<?php echo e($post->color); ?>',
			<?php endif; ?>
			onChange: function (hsb, hex, rgb) {
				$('#color').val('#' + hex);
			}
		});
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
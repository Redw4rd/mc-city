

<?php $__env->startSection('pagetitle'); ?>
	<?php echo e(isset($page['name']) ? $page['name'] : 'Ismeretlen'); ?> oldal szerkesztése
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<form action="" method="post">
		<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
			<label for="name" class="control-label">Oldal megjelenítendő neve </label>
			<input type="text" name="name" class="form-control" value="<?php echo e($page['name']); ?>">
			<?php if($errors->has('name')): ?>
				<span class="help-block"><?php echo e($errors->first('name')); ?></span>
			<?php endif; ?>
		</div>
		
		<div class="form-group<?php echo e($errors->has('body') ? ' has-error' : ''); ?>">
			<label for="body" class="control-label">Oldal tartalma: </label>
			<textarea name="body" id="" cols="30" rows="10"><?php echo $page['body']; ?></textarea>
			<?php if($errors->has('body')): ?>
				<span class="help-block"><?php echo e($errors->first('body')); ?></span>
			<?php endif; ?>
		</div>

		<?php echo e(csrf_field()); ?>

		<input type="hidden" name="slug" value="<?php echo e($page['slug']); ?>">
		<button type="submit" class="btn btn-primary">Oldal mentése</button>
	</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_js'); ?>
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
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
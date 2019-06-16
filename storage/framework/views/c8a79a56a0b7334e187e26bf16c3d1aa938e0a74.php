

<?php $__env->startSection('pagetitle'); ?>
	<?php if($post != 'null'): ?>
		Hír szerkesztése
	<?php else: ?>
		Hír létrehozás
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<form action="" method="post">
		<div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
			<label for="title" class="control-label">Hír címe: </label>
			<input type="text" name="title" class="form-control title" value="<?php if($post != 'null'): ?> <?php echo e($post->title); ?> <?php else: ?> <?php echo e(old('title')); ?> <?php endif; ?>">
			<?php if($errors->has('title')): ?>
				<span class="help-block"><?php echo e($errors->first('title')); ?></span>
			<?php endif; ?>
		</div>

		<div class="form-group<?php echo e($errors->has('slug') ? ' has-error' : ''); ?>">
			<label for="slug" class="control-label">Elérési útvonal: </label>
			<input type="text" name="slug" class="form-control slug" value="<?php if($post != 'null'): ?> <?php echo e($post->slug); ?> <?php else: ?> <?php echo e(old('slug')); ?> <?php endif; ?>">
			<?php if($errors->has('slug')): ?>
				<span class="help-block"><?php echo e($errors->first('slug')); ?></span>
			<?php endif; ?>
		</div>

		<div class="form-group<?php echo e($errors->has('body') ? ' has-error' : ''); ?>">
			<textarea name="body" id="body" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Tartalom"><?php if($post != 'null'): ?> <?php echo $post->body; ?> <?php else: ?> <?php echo e(old('body')); ?> <?php endif; ?></textarea>
			<?php if($errors->has('body')): ?>
				<span class="help-block"><?php echo e($errors->first('body')); ?></span>
			<?php endif; ?>
		</div>
		
		<?php if($post != 'null'): ?>
		<?php echo e(method_field('PUT')); ?>

		<?php endif; ?>
		<?php echo e(csrf_field()); ?>

		<div class="pull-left">
			<button type="submit" class="btn btn-primary">Hír mentése</button>
			<?php if($post != 'null'): ?>
			<small>Utoljára szerkesztve: <?php echo e(date('Y, F d H:i', strtotime($post->updated_at))); ?></small>
			<?php endif; ?>
		</div>
	</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_js'); ?>
	<script src="js/url_slug.js"></script>
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

			$(".title").keyup(function(){

				var slug = url_slug($(this).val(), {
			    	'limit':255
			    });

			    $('.slug').val(slug);
			      
			});
		});
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
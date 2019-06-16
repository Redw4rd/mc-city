<?php $__env->startSection('jumbotron'); ?>
	<?php echo $__env->make('partials.jumbotron', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
	<div class="panel panel-default">
		<div class="panel-heading">Hírek</div>
		<div class="panel-body">
		<?php $__empty_1 = true; foreach($news as $post): $__empty_1 = false; ?>
			<article class="news">
				<header class="article-title"><?php echo e($post->title); ?></header>
				<section class="article-body">
					<?php echo $post->body; ?>

				</section>
				<footer class="article-footer"><small class="label label-primary">Írta: <?php echo e($post->user->username); ?></small><small class="label label-primary">Publikálva: <?php echo e(date('Y, F d H:i', strtotime($post->created_at))); ?></small></footer>
			</article>
		<?php endforeach; if ($__empty_1): ?>
			Nincs megjelenítendő hír az adatbázisban!
		<?php endif; ?>

		<div style="text-align: center; margin-top: 20px"><?php echo e($news->links()); ?></div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php if(Auth::check()): ?>
<?php $__env->startSection('sidebar'); ?>
	<div class="panel panel-default">
		<div class="panel-heading">Felhasználói adatok</div>
		<div class="panel-body">
			<div class="col-sm-4">
				<?php echo Auth::user()->getAvatarImage(80, 'thumbnail'); ?>

			</div>
			<div class="col-sm-8 user-data">
				<span class="fa fa-user"></span> <?php echo e(Auth::user()->getNameOrUsername()); ?> <br>
				<span class="fa fa-gamepad"></span> <?php echo e(Auth::user()->getRankName()); ?> <br>
			<?php if(Auth::user()->hasRank()): ?>
				<span class="fa fa-calendar"></span> Rang lejárata: <?php echo e(date('Y.m.d', strtotime(Auth::user()->rank_expire))); ?><br>
			<?php endif; ?>
				<span class="fa fa-paypal"></span> <?php echo e(number_format(Auth::user()->wallet, 0, '', ',')); ?> Pixel<br>
				<span class="fa fa-clock-o"></span> <?php echo e(date('Y, F d H:i', strtotime(Auth::user()->created_at))); ?>

			</div>
			<div class="col-sm-12">
				<div class="btn-group btn-group-justified">
					<a href="<?php echo e(route('profile')); ?>" class="btn btn-primary" title="Beállítások"><span class="fa fa-cog"></span> Beállítások</a>
					<a href="<?php echo e(route('modify-password')); ?>" class="btn btn-primary" title="Jelszó módosítás"><span class="fa fa-unlock"></span> Jelszó módosítás</a>
				</div>
	
			</div>
			<div class="col-sm-12" style="margin-top: 20px">
				<div class="well">
					<figure class="skin-preview" data-minecraft-username="<?php echo e(Auth::user()->username); ?>"></figure>
				</div>
				<?php if(Auth::user()->hasSkin() !== false): ?>
				<form action="<?php echo e(action('UploadController@removeSkin')); ?>" method="post">
					<?php echo e(csrf_field()); ?>

					<button style="margin-bottom: 10px" name="delete" value="skin" class="btn btn-danger btn-group-justified btn-file" type="submit" title="Skin törlése"><span class="fa fa-trash"></span> Skin törlése</button>
				</form>
				<?php endif; ?>
				<form action="<?php echo e(action('UploadController@skin')); ?>" method="post" class="skin-upload" enctype="multipart/form-data">
					<?php echo e(csrf_field()); ?>

					<div class="btn-group btn-group-justified">
						<div class="btn btn-primary btn-file">
								<span class="fa fa-upload"></span> Skin feltöltése
								<input type="file" name="skin" id="skin" title="Skin feltöltés" required>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startPush('footer_js'); ?>
	<script src="js/jquery.minecraftskin.js"></script>
	<script>
		$(document).ready(function() {
			$('input[type=file]').change(function() {
			    $('form.skin-upload').submit();
			});
		});

		$(".skin-preview").minecraftSkin({scale: 6, hat: true, skinsrequest: '<?php echo e(route('index')); ?>/files/skins/' });
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('header_css'); ?>
	<style>
		div[class$='-big'] {
			line-height: 1em;
			font-size: 300%;
		}
		.panel {
			max-width: 300px;
		}
		.panel-default .panel-heading {
			color: #ffffff;
			text-shadow: 0px 1px 1px #000;
		}
		.panel-heading,
		.panel-body {
			text-align: center;
		}

		.btn {
			margin-top: 20px;
		}

		.flex {
			display: inline-flex;
			flex-flow: row wrap;
			align-items: flex-start;
			justify-content: space-around;
		}

		.flex-item {
			display: inline-block;
			margin: 5px;
			flex: 1 100%;
		}


	</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Támogatás</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="btn-group btn-group-justified">
		<a href="<?php echo e(route('donation.paypal')); ?>" class="btn btn-primary">
			<div class="fa fa-paypal hidden-sm" style="font-size: 200%; vertical-align: middle;"></div>
			<span style="font-size: 150%; vertical-align: middle;" class="hidden-xs">Vásárolj Pixelt PayPallal</span>
		</a>
		<a href="<?php echo e(route('donation.sms')); ?>" class="btn btn-warning">
			<div class="fa fa-commenting-o hidden-sm" style="font-size: 200%; vertical-align: middle;"></div>
			<span style="font-size: 150%; vertical-align: middle;" class="hidden-xs">Vásárolj Pixelt emelt díjas SMS-el</span>
		</a>
	</div>
	<div class="flex" style="margin-top: 20px">
		<?php $__empty_1 = true; foreach($ranks as $rank): $__empty_1 = false; ?>
			<div class="panel panel-default flex-item">
				<div class="panel-heading"<?php if($rank->color): ?> style="background-color: <?php echo e($rank->color); ?>" <?php endif; ?>>
					<div class="rank-name-big"><?php echo e($rank->name); ?></div>
					<div class="rank-price-big"><?php if($rank->price >0 ): ?><?php echo e(number_format($rank->price, 0, '', ',')); ?> Pixel <?php else: ?> Ingyenes <?php endif; ?></div>
				</div>
				<div class="panel-body">
					<div class="rank-description">
						<?php echo $rank->description; ?>

					</div>

					<?php if($rank->price > 0): ?>
						<button data-rank-name="<?php echo e($rank->name); ?>" data-rank-price="<?php echo e($rank->price); ?>" data-href="<?php echo e(route('donation.process', $rank->id)); ?>" class="btn btn-primary rankBuy"><span class="fa fa-shopping-cart"></span> Vásárlás</button>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; if ($__empty_1): ?>
			Az adminisztrátor még nem állította be a rangokat!
		<?php endif; ?>
	</div>
	<img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" style="display: block; margin: 20px auto" alt="Credit Card Badges">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer_js'); ?>;
	<?php if(\Auth::user()): ?>
	<script>
		$('.rankBuy').click(function(){
			if (<?php echo e(\Auth::user()->rank_id); ?> != 0) {
				if (confirm('Biztosan le szeretnéd cerélni a kelenlegi (<?php echo e(\Auth::user()->getRankName()); ?>) a ' + $(this).data('rank-name') + ' rangért cserébe? (Az előző rag teljesen elveszik)')) {
					window.location.replace($(this).data('href'));
				} else {
					return false;
				}
			} else {
				if (confirm('Biztosan meg akarod vásárolni a ' + $(this).data('rank-name') + ' rangot ' + $(this).data('rank-price') + ' Pixelért?')) {
					window.location.replace($(this).data('href'));
				} else {
					return false;
				}
			}
		});
	</script>
	<?php else: ?>
	<script>
		$('.rankBuy').click(function(){
			alert('Rang vásárláshoz be kell jelentkezned!');			
		});
	</script>
	<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
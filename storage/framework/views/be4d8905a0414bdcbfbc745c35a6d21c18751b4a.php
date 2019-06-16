

<?php $__env->startSection('jumbotron'); ?>
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Fizetés PayPalon keresztül</h1>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div style="text-align: center; font-size: 800%">
					<div class="total-price">0 Ft</div>
				</div>

				<form action="" method="post">
					<label for="pixel">Mennyi Pixelt szeretnél vásárolni?</label>
					<div class="input-group">
						<input type="number" name="pixel" min="<?php echo e($site['paypal_min_amount']); ?>" class="form-control input-lg pixel" placeholder="2000">
						<span class="input-group-addon">Pixel</span>
					</div>

					<?php echo e(csrf_field()); ?>


					<div style="margin: 50px auto">
						<!--<button class="btn btn-primary btn-lg col-md-6 col-md-offset-3">Tovább a fizetéshez <span class="fa fa-arrow-right"></span></button>-->
						<button class="btn btn-lg col-md-6 col-md-offset-3" style="width: 340px;"><img src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"></button>
					</div>
				</form>

				<div style="margin: 20px 0"></div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer_js'); ?>
	<script>
		var min_pixel=<?php echo e($site['paypal_min_amount']); ?>;
		var discount_percentage=<?php echo e($site['paypal_discount']); ?>;
		var input = $('.pixel');
		var price = 0;

		$(input).on('input', function() {
			$(".total-price").text("Számítás...");
			
			setTimeout(function() {
				var counter = $(input).val().length;

				if (counter >= 3) {
					if (input.val() < min_pixel) {
						$(input).val(min_pixel);
					}
				}

				price = Math.ceil((input.val()/2)/(1+(discount_percentage/100)));

				$(".total-price").text(price + " Ft");
			}, 1500);
		});
		
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
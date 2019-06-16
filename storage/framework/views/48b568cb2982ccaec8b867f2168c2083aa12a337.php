<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PixelHero</title>
</head>
<body style="margin: 0;padding: 0;font-family: 'Helvetica Neue', sans-serif;font-size: 14px;background-color: #eee;margin-top: 30px;">
	<table class="wrapper" style="margin: 0 auto;padding: 0;width: 100%;max-width: 600px;">
		<tr style="margin: 0;padding: 0;">
			<td align="center" style="margin: 0;padding: 0;"><img src="<?php echo e(asset('images/pixelhero-logo.png')); ?>" alt="PixelHero Logo" width="100" height="100" style="margin: 0;padding: 0;"></td>
		</tr>
	</table>
	<table class="wrapper container" style="margin: 0 auto;padding: 10px;width: 100%;max-width: 600px;background-color: #fff;line-height: 1.5em;">
		<tr style="margin: 0;padding: 0;">
			<td style="margin: 0;padding: 0;">
				<?php echo $__env->yieldContent('content'); ?>
			</td>
		</tr>
	</table>
	<table class="wrapper" style="margin: 0 auto;padding: 0;width: 100%;max-width: 600px;">
		<tr style="margin: 0;padding: 0;">
			<td align="center" style="margin: 0;padding: 0;"><a href="<?php echo e(route('index')); ?>" style="margin: 0;padding: 0;color: #7D8C8C;">Weboldal</a> | <a href="<?php echo e(route('unsubscribe')); ?>" style="margin: 0;padding: 0;color: #7D8C8C;">Leiratkozás</a> | <a href="<?php echo e(route('contact')); ?>" style="margin: 0;padding: 0;color: #7D8C8C;">Kapcsolatfelvétel</a></td>
		</tr>
	</table>
</body>
</html>
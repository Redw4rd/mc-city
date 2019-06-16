
<?php $__env->startSection('content'); ?>
	<h3>Kedves <?php echo e($mail['username']); ?>!</h3>

	<p>Te vagy valaki más jelszó módosítást szeretne végrehajtani a felhasználói fiókodon.
	Amennyiben nem te kérted a jelszvad módosítását, hagyd figyelmen kívül ezt az üzenetet.</p>

	<p>Ha te voltál a kérvényező, kérlek kattints az alábbi linkre: <br>
	<a href="<?php echo e(route('lost-password', $mail['token'])); ?>"><?php echo e(route('lost-password', $mail['token'])); ?></a></p>
	<br>
	Ha bármilyen problémád merül fel a jövőben, nyugodtan jelezd azt felénk hibajegyen, a weboldalon található kapcsolat menüponton, vagy Facebook üzeneten keresztül!<br>
	<br>
	További jó játékot kíván a <a href="<?php echo e(route('index')); ?>">PixelHero csapata!</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.email', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
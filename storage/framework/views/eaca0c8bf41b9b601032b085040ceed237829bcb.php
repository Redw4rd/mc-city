
<?php $__env->startSection('content'); ?>
	<h3>Kedves, <?php echo e($mail['username']); ?>!</h3>
	<br>
	Ezúton értesítelek, hogy sikeresen regisztráltál a <?php echo e($site['title']); ?> weboldalán. Fontos, hogy az oldalt, illetve a klienst csak azután tudod használni, miután megerősítetted a regisztrációdat!<br>
	<br>
	Az alábbi linkre kattintva megerősítheted regisztrációd: <a href="<?php echo e(route('account-verification', $mail['verify_token'])); ?>"><?php echo e(route('account-verification', $mail['verify_token'])); ?></a><br>
	<br>
	Ha bármilyen problémád merül fel a jövőben, nyugodtan jelezd azt felénk hibajegyen, a weboldalon található kapcsolat menüponton, vagy Facebook üzeneten keresztül!<br>
	<br>
	További jó játékot kíván a <a href="<?php echo e(route('index')); ?>">PixelHero csapata!</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.email', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
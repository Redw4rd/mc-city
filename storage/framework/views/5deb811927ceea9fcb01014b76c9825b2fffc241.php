<div class="jumbotron">
	<div class="jumbotron-background">
		<div class="jumbotron-overlay"></div>
	</div>
	<div class="container">
	<?php if(Auth::user()): ?>
		<h1>Üdvözöllek, <?php echo e(Auth::user()->getNameOrUsername()); ?>!</h1>
		<p>Nagyon jó. Örülök, hogy rátaláltál a helyes utadra. Mi akadályoz hát, mi tart vissza? <br> Folytasd az utad, hogy hőssé válj!</p>
		<a href="<?php echo e(route('downloads')); ?>" class="btn btn-primary btn-lg">Kliens letöltése</a>
	<?php else: ?>
		<h1>Üdvözöllek, vándor!</h1>
		<p>Mindig is égett benned a kalandok utáni vágy? Szeretted a kihívásokat, a küzdelmet? Mire vársz még, barátom? Csatlakozz Magyarország legegyedibb, legizgalmasabb Minecraft szerveréhez és éld át életed legnagyobb kalandját!</p>
		<a href="<?php echo e(route('registration')); ?>" class="btn btn-primary btn-lg">Regisztráció</a>
	<?php endif; ?>
	</div>
</div>
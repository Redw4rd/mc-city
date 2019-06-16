

<?php $__env->startPush('header_css'); ?>
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('pagetitle'); ?>
	Felhasználók
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="panel panel-default">
		<div class="panel-heading"><div class="panel-text">Felhasználók</div></div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover" id="users">
				<thead>
					<tr>
						<td>#ID</td>
						<td>Felhasználónév</td>
						<td>Név</td>
						<td>Rang</td>
						<td>Jog</td>
						<td>Státusz</td>
						<td>Regisztráció időpontja</td>
						<td>Műveletek</td>
					</tr>
				</thead>
				<tbody>
				<?php foreach($users as $user): ?>
					<tr class="clickable-row" style="cursor: pointer" data-href="<?php echo e(route('users', $user->username)); ?>">
						<td><?php echo e($user->id); ?></td>
						<td><?php echo e($user->username); ?></td>
						<td><?php echo e($user->name); ?></td>
						<td><?php echo e($user->getRankName()); ?></td>
						<td>
							<?php if($user->isAdmin()): ?>
							Adminisztrátor
							<?php else: ?>
							Felhasználó
							<?php endif; ?>
						</td>
						<td><?php if(is_null($user->verify_token)): ?> Aktiválva <?php else: ?> Inaktív <?php endif; ?></td>
						<td><?php echo e(date('Y, F d H:i', strtotime($user->created_at))); ?></td>
						<td>
							<div class="pull-left">
								<a href="<?php echo e(route('users', $user->username)); ?>" class="btn btn-info btn-xs"><span class="fa fa-eye" title="Megtekintés"></span> <span class="hidden-xs">Megtekintés</span></a>
							</div>
							<div class="pull-right">
								<form action="" method="post">
									<input type="hidden" name="DELETE" value="yes">
									<input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
									<?php echo e(csrf_field()); ?>

									<button type="submit" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Törlés</button>
								</form>
							</div>
							<div class="clearfix"></div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_js'); ?>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#users').DataTable({
				responsive: true,
				paging: true,
				order: [[0, "desc"], [2, "desc"]],
				language: {
					"sEmptyTable":     "Nincs rendelkezésre álló adat",
					"sInfo":           "Találatok: _START_ - _END_ Összesen: _TOTAL_",
					"sInfoEmpty":      "Nulla találat",
					"sInfoFiltered":   "(_MAX_ összes rekord közül szűrve)",
					"sInfoPostFix":    "",
					"sInfoThousands":  " ",
					"sLengthMenu":     "_MENU_ találat oldalanként",
					"sLoadingRecords": "Betöltés...",
					"sProcessing":     "Feldolgozás...",
					"sSearch":         "Keresés:",
					"sZeroRecords":    "Nincs a keresésnek megfelelő találat",
					"oPaginate": {
					   "sFirst":    "Első",
					   "sPrevious": "Előző",
					   "sNext":     "Következő",
					   "sLast":     "Utolsó"
					},
					"oAria": {
					   "sSortAscending":  ": aktiválja a növekvő rendezéshez",
					   "sSortDescending": ": aktiválja a csökkenő rendezéshez"
					}
				}
			});

			$(".clickable-row").click(function() {
				window.document.location = $(this).data("href");
			});
		});
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
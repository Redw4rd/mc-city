

<?php $__env->startPush('header_css'); ?>
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('pagetitle'); ?>
	Log
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
	<div class="panel panel-default">
		<div class="panel-heading"><div class="panel-text">Log</div></div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover" id="log">
				<thead>
					<tr>
						<td>#ID</td>
						<td>Terület</td>
						<td>Log</td>
						<td>Felhasználó</td>
						<td>Mentve</td>
					</tr>
				</thead>
				<tbody>
				<?php foreach($activity as $log): ?>
					<tr style="cursor: pointer">
						<td><?php echo e($log->id); ?></td>
						<td><?php echo e($log->log_name); ?></td>
						<td><?php echo e($log->description); ?></td>
						<td><?php if(($user = \App\User::find($log->causer_id)) != null): ?> <?php echo e($user->username); ?> <?php else: ?> Rendszer <?php endif; ?></td>
						<td><?php echo e($log->created_at); ?></td>
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
			$('#log').DataTable({
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
		});
	</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
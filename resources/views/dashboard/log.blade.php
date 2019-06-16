@extends('layouts.dashboard')

@push('header_css')
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
@endpush

@section('pagetitle')
	Log
@stop

@section('page')
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
				@foreach($activity as $log)
					<tr style="cursor: pointer">
						<td>{{ $log->id }}</td>
						<td>{{ $log->log_name }}</td>
						<td>{{ $log->description }}</td>
						<td>@if(($user = \App\User::find($log->causer_id)) != null) {{ $user->username }} @else Rendszer @endif</td>
						<td>{{ $log->created_at }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop

@push('footer_js')
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
@endpush
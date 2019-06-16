@extends('layouts.dashboard')

@push('header_css')
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
@endpush

@section('pagetitle')
	Hibajegyek
@stop

@section('page')
	<div class="panel panel-default">
		<div class="panel-heading"><div class="panel-text">Beküldött hibajegyek</div></div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover" id="tickets">
				<thead>
					<tr>
						<td>#ID</td>
						<td>Kategória</td>
						<td>Beküldő</td>
						<td></td>
						<td>Utolsó aktivitás</td>
						<td>Státusz</td>
						<td>Műveletek</td>
					</tr>
				</thead>
				<tbody>
				@foreach($tickets as $ticket)
					<tr class="clickable-row" style="cursor: pointer" data-href="{{ route('dashboard.tickets', $ticket->id) }}">
						<td>{{ $ticket->id }}</td>
						<td>{{ $ticket->type }}</td>
						<td>{{ $ticket->user->username }}</td>
						<td>{{ str_limit($ticket->message, 30) }}</td>
						<td>{{ date('Y, F d', strtotime($ticket->updated_at)) }}</td>
						<td>
						@if($ticket->is_locked)
							<span class="label label-danger"><span class="fa fa-lock"></span> <span class="hidden-xs">Zárolva</span></span>
						@else
						@if($ticket->answered)
							<span class="label label-success"><span class="fa fa-check"></span> <span class="hidden-xs">Megválaszolva</span></span>
						@else
							<span class="label label-warning"><span class="fa fa-eye-slash"></span> <span class="hidden-xs">Válaszra vár</span></span>
						@endif
						@endif
						</td>
						<td>
							<a href="{{ route('dashboard.tickets', $ticket->id) }}" class="btn btn-info btn-xs"><span class="fa fa-eye" title="Megtekintés"></span> <span class="hidden-xs">Megtekintés</span></a>
						</td>
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
			$('#tickets').DataTable({
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
@endpush
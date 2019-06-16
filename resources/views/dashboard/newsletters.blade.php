@extends('layouts.dashboard')

@push('header_css')
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
@endpush

@section('pagetitle')
	Hírlevelek
@stop

@section('page')
	<div class="panel panel-default">
		<div class="panel-heading"><div class="panel-text">Hírlevelek</div></div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover" id="tickets">
				<thead>
					<tr>
						<td>#ID</td>
						<td>Neve</td>
						<td>Kiküldve</td>
						<td>Befejezve?</td>
						<td>Létrehozva</td>
						<td>Műveletek</td>
					</tr>
				</thead>
				<tbody>
				@foreach($newsletters as $mail)
					<tr class="clickable-row" style="cursor: pointer">
						<td>{{ $mail->id }}</td>
						<td>{{ $mail->name }}</td>
						<td>{{ $mail->status }}</td>
						<td>@if($mail->finished) Igen @else Nem @endif</td>
						<td>{{ date('Y, F d H:i', strtotime($mail->created_at)) }}</td>
						<td>
							<form action="{{ action('DashboardController@deleteNewsletter') }}" method="post">
								<input type="hidden" name="DELETE" value="yes">
								<input type="hidden" name="id" value="{{ $mail->id }}">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Törlés</button>
							</form>
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
		});
	</script>
@endpush
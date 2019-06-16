@extends('layouts.dashboard')

@push('header_css')
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
@endpush

@section('pagetitle')
	Rangok
@stop

@section('page')
	<div class="panel panel-default">
		<div class="panel-heading">
			Rangok

			<div class="pull-right">
				<a href="{{ route('ranks', 'new') }}" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span> Új Rang létrehozása</a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover" id="tickets">
				<thead>
					<tr>
						<td>#ID</td>
						<td>Név</td>
						<td>Csoport</td>
						<td>Leírás</td>
						<td>Ár</td>
						<td>Műveletek</td>
					</tr>
				</thead>
				<tbody>
				@foreach($ranks as $rank)
					<tr class="clickable-row" style="cursor: pointer" data-href="{{ route('ranks', $rank->id) }}">
						<td>{{ $rank->id }}</td>
						<td>{{ $rank->name }}</td>
						<td>{{ $rank->group }}</td>
						<td>{{ str_limit(strip_tags($rank->description), 30) }}</td>
						<td>{{ $rank->price }} Pixel</td>
						<td>
							<div class="pull-left">
								<a href="{{ route('ranks', $rank->id) }}" class="btn btn-info btn-xs"><span class="fa fa-eye" title="Megtekintés"></span> <span class="hidden-xs">Megtekintés</span></a>
							</div>
							<div class="pull-right">
								<form action="" method="post">
									<input type="hidden" name="DELETE" value="yes">
									<input type="hidden" name="rank_id" value="{{ $rank->id }}">
									{{ csrf_field() }}
									<button type="submit" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Törlés</button>
								</form>
							</div>
							<div class="clearfix"></div>
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
			$('#ranks').DataTable({
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
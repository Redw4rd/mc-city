@extends('layouts.dashboard')

@push('header_css')
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
@endpush

@section('pagetitle')
	Felhasználók
@stop

@section('page')
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
				@foreach($users as $user)
					<tr class="clickable-row" style="cursor: pointer" data-href="{{ route('users', $user->username) }}">
						<td>{{ $user->id }}</td>
						<td>{{ $user->username }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->getRankName() }}</td>
						<td>
							@if($user->isAdmin())
							Adminisztrátor
							@else
							Felhasználó
							@endif
						</td>
						<td>@if(is_null($user->verify_token)) Aktiválva @else Inaktív @endif</td>
						<td>{{ date('Y, F d H:i', strtotime($user->created_at)) }}</td>
						<td>
							<div class="pull-left">
								<a href="{{ route('users', $user->username) }}" class="btn btn-info btn-xs"><span class="fa fa-eye" title="Megtekintés"></span> <span class="hidden-xs">Megtekintés</span></a>
							</div>
							<div class="pull-right">
								<form action="" method="post">
									<input type="hidden" name="DELETE" value="yes">
									<input type="hidden" name="user_id" value="{{ $user->id }}">
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
@endpush
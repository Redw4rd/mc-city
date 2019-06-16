@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Tevékenységeim</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<table class="table table-striped table-hover">
		<thead class="thead">
			<tr>
				<td>Dátum</td>
				<td>Terület</td>
				<td>Tevékenység</td>
			</tr>
		</thead>
		<tbody>
			@forelse($activity_log as $log)
			<tr>
				<td>{{ $log->created_at }}</td>
				<td>{{ $log->log_name }}</td>
				<td>{{ $log->description }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="6">Nincs rendelkezésre álló adat!</td>
			</tr>
			@endforelse
		</tbody>
	</table>

	<div style="text-align: center">{{ $activity_log->links() }}</div>
@stop
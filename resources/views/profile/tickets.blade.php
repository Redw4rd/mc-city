@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Hibajegyek</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	@if($errors->all())
	<div class="alert alert-warning">
	<button type="button" 
        class="close" 
        data-dismiss="alert" 
        aria-hidden="true">&times;</button>
	@foreach($errors->all() as $error)
		{{ $error }} <br>
	@endforeach
	</div>
	@endif
	<button class="btn btn-primary" data-toggle="collapse" data-target="#add" style="float: right; margin: 10px 0"><i class="fa fa-plus"></i> Új hibajegy</button>
	<div class="clearfix"></div>
	<div class="panel panel-default collapse" id="add">
		<div class="panel-heading"><div class="panel-text">Hibajegy nyitás</div></div>
		<div class="panel-body">
			<form action="" method="POST">
				<label for="category">Kategória</label>
				<select name="category" class="form-control full-width" id="category">
				@foreach($settings['types'] as $type)
				<option value="{{ $type }}">{{ $type }}</option>
				@endforeach
				</select>

				<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
					<label for="message">Fejtsd ki problémád</label>
					<textarea name="message" id="message" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%">{{ old('message') }}</textarea>
					@if($errors->has('message'))
						<span class="help-block">{{ $errors->first('message') }}</span>
					@endif
				</div>
				{{ csrf_field() }}
				<button class="btn btn-primary btn-lg" type="submit" style="margin: 20px 0">Hibajegy beküldése</button>
			</form>
		</div>
	</div>

	<table class="table table-striped table-hover">
		<thead class="thead">
			<tr>
				<td>#ID</td>
				<td>Kategória</td>
				<td></td>
				<td>Utolsó aktivitás</td>
				<td>Státusz</td>
				<td>Műveletek</td>
			</tr>
		</thead>
		<tbody>
			@forelse($tickets as $ticket)
			<tr data-href="{{ route('tickets', $ticket->id) }}">
				<td>{{ $ticket->id }}</td>
				<td>{{ $ticket->type }}</td>
				<td>{{ str_limit($ticket->message, 60) }}</td>
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
					<a href="{{ route('tickets', $ticket->id) }}" class="btn btn-info btn-xs"><span class="fa fa-eye" title="Megtekintés"></span> <span class="hidden-xs">Megtekintés</span></a>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="6">Nincs rendelkezésre álló adat!</td>
			</tr>
			@endforelse
		</tbody>
	</table>

	<div style="text-align: center">{{ $tickets->links() }}</div>
@stop

@push('footer_js')
	<script>
		$('[data-href]').click(function() {
			window.document.location = $(this).data("href");
		}).addClass('link');
	</script>
@endpush
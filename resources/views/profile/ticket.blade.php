@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>#{{ $ticket->id }} Hibajegy megtekintése</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="container">
		<div class="row">
			<div class="well">
				<ul class="comments">
					@if(!$ticket->is_locked)
					<li style="background-color: transparent; margin-bottom: 40px">
					<form action="" method="post">
						<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
							<textarea name="message" id="message" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Ide írd további problémádat a beküldött hibajeggyel kapcsolatban">{{ old('message') }}</textarea>
							@if($errors->has('message'))
								<span class="help-block">{{ $errors->first('message') }}</span>
							@endif
						</div>
						{{ method_field('PUT') }}
						{{ csrf_field() }}
						<input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
						<button type="submit" class="btn btn-primary btn-sm">Üzenet küldése</button>
					</form>
					</li>
					<li>
						<div class="comment-heading">
							<div class="pull-left">
								<strong>{{ $ticket->user->username }}</strong>
							</div>
							<div class="pull-right">
								<small class="label label-default">{{ $ticket->created_at }}</small>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="comment-body">
							{{ $ticket->message }}
						</div>
					</li>
					@endif
					@foreach($ticket->messages as $message)
					<li>
						<div class="comment-heading">
							<div class="pull-left">
								<strong>{{ $message->userdata->username }}</strong>
								@if($message->userdata->is_admin)
									<small class="label label-primary">Ügyfélszolgálat</small>
								@endif
							</div>
							<div class="pull-right">
								<small class="label label-default">{{ $message->created_at }}</small>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="comment-body">
							{{ $message->message }}
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@stop
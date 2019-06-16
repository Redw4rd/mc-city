@extends('layouts.dashboard')

@push('header_css')
	<style>
        ul.comments {
            padding: 0;
            list-style: none;
        }
        ul.comments li {
            margin: 20px 0;
            background-color: #eee
        }
        ul.comments li .comment-heading {
            background-color: #2c3e50;
            padding: 5px;

            font-size: 16px;
            color: #fff;
        }
        ul.comments li .comment-body {
            padding: 5px
        }
    </style>
@endpush

@section('pagetitle')
	#{{ $ticket->id }} hibajegy
@stop

@section('page')
	<div class="well">
		<div class="pull-right">
			<form action="" method="post">
				<input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
				{{ method_field('POST') }}
				{{ csrf_field() }}
				<button type="submit" class="btn btn-danger btn-xs" @if($ticket->is_locked) disabled @endif><span class="fa fa-lock"></span> Hibajegy zárolása</button>
			</form>
			<div class="clearfix"></div>
		</div>
		<div style="margin-bottom: 30px"></div>
		<ul class="comments">
			@if(!$ticket->is_locked)
			<li style="background-color: transparent; margin-bottom: 40px">
			<form action="" method="post">
				<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
					<textarea name="message" id="message" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Megoldásnak vélt üzenet">{{ old('message') }}</textarea>
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
		</ul>
	</div>
@stop
@extends('layouts.dashboard')

@section('pagetitle')
	{{ $user->username }} profilja
@stop

@section('page')
	<div class="panel panel-default">
		<div class="panel-heading">Felhasználó adatai</div>
		<div class="panel-body">
			<form action="" method="post" name="updateUser">
				<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<label for="username" class="control-label">Felhasználónév: </label>
					<input type="text" name="username" class="form-control" value="{{ $user->username }}">
					@if($errors->has('username'))
						<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="control-label">Név: </label>
					<input type="text" name="name" class="form-control" value="{{ $user->name }}">
					@if($errors->has('name'))
						<span class="help-block">{{ $errors->first('name') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="control-label">E-mail cím: </label>
					<input type="text" name="email" class="form-control" value="{{ $user->email }}">
					@if($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('rank') ? ' has-error' : '' }}">
					<label for="rank" class="control-label">Rang: </label>
					<select name="rank" class="form-control" id="rank">
						<option value="0">Nincs</option>
						@foreach($ranks as $rank)
						<option value="{{ $rank->id }}" @if($user->rank_id == $rank->id) selected @endif>{{ $rank->name }}</option>
						@endforeach
					</select>
					@if($errors->has('rank'))
						<span class="help-block">{{ $errors->first('rank') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">
					<label for="is_admin" class="control-label">Jogosultság: </label>
					<select name="is_admin" class="form-control" id="is_admin">
						<option value="0" @if(!$user->isAdmin()) selected @endif>Felhasználó</option>
						<option value="1" @if($user->isAdmin()) selected @endif>Adminisztrátor</option>
					</select>
					@if($errors->has('is_admin'))
						<span class="help-block">{{ $errors->first('is_admin') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('wallet') ? ' has-error' : '' }}">
					<label for="wallet" class="control-label">Pénztárca egyenleg: </label>
					<input type="number" name="wallet" class="form-control" value="{{ $user->wallet }}">
					@if($errors->has('wallet'))
						<span class="help-block">{{ $errors->first('wallet') }}</span>
					@endif
				</div>

				<input type="hidden" name="user_id" value="{{ $user->id }}">
				{{ method_field('PUT') }}
				{{ csrf_field() }}
			</form>
			<button type="submit" class="btn btn-primary pull-left" id="updateUser">Mentés</button>
			@if(!is_null($user->verify_token))
			<form action="{{ action('DashboardController@activateUser') }}" name="activateUser" method="post">
				<input type="hidden" name="user_id" value="{{ $user->id }}">
				<input type="hidden" name="ACTIVATE" value="yes">
				{{ csrf_field() }}
			</form>
			<button type="submit" id="activateUser" class="btn btn-warning" style="margin-left: 20px">Felhasználó aktiválása</button>
			@endif
		</div>
	</div>
@stop
@push('footer_js')
	<script>
		$(document).ready(function() {
			$("#activateUser").on('click', function() {
				$("form[name='activateUser']").submit();
			});

			$("#updateUser").on('click', function() {
				$("form[name='updateUser']").submit();
			});
		});
	</script>
@endpush
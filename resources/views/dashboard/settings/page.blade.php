@extends('layouts.dashboard')

@section('pagetitle')
	Weboldal beállítások
@stop

@section('page')
	<form action="" method="post">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Oldal beállítások</div>
					<div class="panel-body">
						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							<label for="title" class="control-label">Oldal neve: </label>
							<input type="text" name="title" class="form-control" value="{{ $site['title'] }}">
							@if($errors->has('title'))
								<span class="help-block">{{ $errors->first('title') }}</span>
							@endif
						</div>

						<div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
							<label for="keywords" class="control-label">Kulcsszavak: </label>
							<input type="text" name="keywords" class="form-control" value="{{ $site['keywords'] }}">
							@if($errors->has('keywords'))
								<span class="help-block">{{ $errors->first('keywords') }}</span>
							@endif
						</div>

						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label for="description" class="control-label">Leírás: </label>
							<input type="text" name="description" class="form-control" value="{{ $site['description'] }}">
							@if($errors->has('title'))
								<span class="help-block">{{ $errors->first('description') }}</span>
							@endif
						</div>				
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Közzösségi oldalak</div>
					<div class="panel-body">
						<div class="form-group{{ $errors->has('social_facebook_link') ? ' has-error' : '' }}">
							<label for="social_facebook_link" class="control-label">Facebook oldal: </label>
							<input type="text" name="social_facebook_link" class="form-control" value="{{ $site['social_facebook_link'] }}">
							@if($errors->has('social_facebook_link'))
								<span class="help-block">{{ $errors->first('social_facebook_link') }}</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('social_youtube_link') ? ' has-error' : '' }}">
							<label for="social_youtube_link" class="control-label">Youtube csatorna: </label>
							<input type="text" name="social_youtube_link" class="form-control" value="{{ $site['social_youtube_link'] }}">
							@if($errors->has('social_youtube_link'))
								<span class="help-block">{{ $errors->first('social_youtube_link') }}</span>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		{{ csrf_field() }}
		<div class="clearfix"></div>
		<button type="submit" class="btn btn-primary">Mentés</button>
	</form>
@stop
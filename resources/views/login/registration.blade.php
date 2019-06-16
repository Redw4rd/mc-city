@extends('layouts.frontend')
@section('background')
	<div class="login-background"></div>
@stop
@section('page')
	<div class="container">
		<div class="row">
			<section class="registration-box">
				<div class="panel panel-default">
					<div class="panel-heading">Regisztráció</div>
					<div class="panel-body">
						<form action="" method="post">
							<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
								<label for="username" class="control-label">Felhasználónév: </label>
								<input type="text" name="username" class="form-control" value="{{ old('username') }}">
								@if($errors->has('username'))
									<span class="help-block">{{ $errors->first('username') }}</span>
								@endif
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label for="email" class="control-label">E-mail cím: </label>
										<input type="text" name="email" class="form-control" value="{{ old('email') }}">
										@if($errors->has('email'))
											<span class="help-block">{{ $errors->first('email') }}</span>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group{{ $errors->has('email_re') ? ' has-error' : '' }}">
										<label for="email_re" class="control-label">E-mail cím megerősítése: </label>
										<input type="text" name="email_re" class="form-control" value="">
										@if($errors->has('email_re'))
											<span class="help-block">{{ $errors->first('email_re') }}</span>
										@endif
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label for="password" class="control-label">Jelszó: </label>
										<input type="password" name="password" class="form-control" value="">
										@if($errors->has('password'))
											<span class="help-block">{{ $errors->first('password') }}</span>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label for="password_re" class="control-label">Jelszó megerősítése: </label>
										<input type="password" name="password_re" class="form-control" value="">
										@if($errors->has('password_re'))
											<span class="help-block">{{ $errors->first('password_re') }}</span>
										@endif
									</div>
								</div>
							</div>
							<div class="checkbox">
								<div class="form-group{{ $errors->has('over_13') ? ' has-error' : '' }}">
									<input type="checkbox" name="over_13">
									<span class="checkbox-text">Kijelentem, hogy 13 éves, vagy annál idősebb vagyok.</span>
									@if($errors->has('over_13'))
										<span class="help-block">{{ $errors->first('over_13') }}</span>
									@endif
								</div>
							</div>
							<div class="checkbox">
								<div class="form-group{{ $errors->has('aszf_accept') ? ' has-error' : '' }}">
									<input type="checkbox" name="aszf_accept">
									<span class="checkbox-text">Elfogadom az <a href="{{ route('site', 'aszf') }}">Általános Szerződési Feltételeket</a>, az <a href="{{ route('site', 'aff') }}">Általános Felhasználói Feltételeket</a>, illetve a <a href="{{ route('site', 'rules') }}">Szabályzatot</a>.</span>
									@if($errors->has('aszf_accept'))
										<span class="help-block">{{ $errors->first('aszf_accept') }}</span>
									@endif
								</div>
							</div>
							<div class="checkbox">
								<div class="form-group">
									<input type="checkbox" name="newsletter" checked>
									<span class="checkbox-text">Szeretnék a jövőben a szerverrel kapcsolatos hírleveleket kapni.</span>
								</div>
							</div>
							{{ csrf_field() }}
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
										@if($errors->has('g-recaptcha-response'))
											<span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>
										@endif
										{!! \Recaptcha::render() !!}
									</div>
								</div>
								<div class="col-sm-6">
									<input type="submit" class="btn btn-primary btn-lg" value="Regisztráció">
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
@stop
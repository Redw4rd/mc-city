@extends('layouts.frontend')

@section('background')
	<div class="login-background"></div>
@stop
@section('page')
	<div class="container">
		<section class="registration-box">
			<div class="panel panel-default">
				<div class="panel-heading">Elfelejtettem a jelszavam</div>
				<div class="panel-body">
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
				@if($withcode)
					<form action="" method="post">
						<input type="password" name="password" class="form-control" placeholder="Új jelszó">
						<input type="password" name="password_re" class="form-control" placeholder="Új jelszó megerősítése">
						<input type="hidden" name="_password_reset" value="{{ $withcode }}">

						{{ csrf_field() }}
						<input type="submit" class="btn btn-warning btn-lg" value="Jelszó módosítás">
					</form>
				@else
					<form action="" method="post">
						<div class="alert alert-info">
							Az elfelejtett jelszó funkció segítségével, visszaszerezheted felhasználói fiókod. Az általad megadott e-mail címre kiküldünk egy azonosító kódot, melyet megadva megtudod változtatni jelszavad! <strong>(A megerősítő kódot csak egyszer használhatod!)</strong>
						</div>

						<input type="text" name="email" class="form-control" placeholder="Regisztrált e-mail címed">

						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-6">
								{!! \Recaptcha::render() !!}
							</div>
							<div class="col-sm-6">
								<input type="submit" class="btn btn-warning btn-lg" value="E-mail kiküldése">
							</div>
						</div>						
					</form>
				@endif
				</div>
			</div>
		</section>
	</div>
@stop
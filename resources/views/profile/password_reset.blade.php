@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Jelszó módosítás</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Jelszó módosítás</div>
					<div class="panel-body">
						<form action="" method="post">
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="control-label">Új jelszó: </label>
								<input type="password" name="password" class="form-control" value="">
								@if($errors->has('password'))
									<span class="help-block">{{ $errors->first('password') }}</span>
								@endif
							</div>
							
							<div class="form-group{{ $errors->has('password_re') ? ' has-error' : '' }}">
								<label for="password_re" class="control-label">Új jelszó megerősítése: </label>
								<input type="password" name="password_re" class="form-control" value="">
								@if($errors->has('password_re'))
									<span class="help-block">{{ $errors->first('password_re') }}</span>
								@endif
							</div>

							{{ csrf_field() }}
							<button type="submit" class="btn btn-primary">Jelszó módosítása</button>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-4 hidden-xs" style="position: absolute; top: 20%; bottom: 0; right: 0">
				<img src="images/skeletongirl_2.png" class="img-responsive" alt="Skeleton girl">
			</div>
		</div>
	</div>
@stop
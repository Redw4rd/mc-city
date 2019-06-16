@extends('layouts.frontend')

@section('background')
	<div class="login-background"></div>
@stop
@section('page')
	<div class="container">
		<section class="registration-box">
			<div class="panel panel-default">
				<div class="panel-heading">Leiratkozás</div>
				<div class="panel-body">
					<form action="" method="post">
						<input type="text" name="email" class="form-control" placeholder="Regisztrált e-mail címed">

						{{ csrf_field() }}
						<input type="submit" class="btn btn-warning btn-lg" value="Leiratkozás">					
					</form>
				</div>
			</div>
		</section>
	</div>
@stop
@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Térkép</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="container">
		<div class="row">
			<iframe src="http://s1.pixelhero.hu/dynmap/?username=@if (Auth::check()){{ Auth::user()->getNameOrUsername() }}@endif" width="100%" height="800">
				<p>Your browser does not support iframes.</p>
			</iframe>
		</div>
	</div>
@stop
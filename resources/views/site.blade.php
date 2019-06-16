@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>{{ $page['name'] }}</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="container">
		<div class="row">
			{!! $page['body'] !!}
		</div>
	</div>
@stop
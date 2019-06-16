@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Kapcsolat</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="container">
		<div class="row">
			<div id="kapcsolat">
				<div class="page-content">
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
					<form action="" method="post" class="contact-sendform">
						<div class="row">
							<div class="col-sm-6">
								<label for="name" class="full-width">Neved</label>
								<input type="text" name="name" class="form-control full-width" placeholder="Neved" value="{{ old('name') }}" required>
							</div>
							<div class="col-sm-6">
								<label for="email" class="full-width">E-mail címed</label>
								<input type="text" name="email" class="form-control full-width" value="{{ old('email') }}" placeholder="E-mail címed" required>
							</div>
							<div class="col-sm-12">
								<label for="type" class="full-width">E-mail tárgya</label>
								<select name="type" id="type" class="form-control full-width">
								@foreach($settings['types'] as $type)
									<option value="{{ $type }}">{{ $type }}</option>
								@endforeach
								</select>
							</div>
							<div class="col-sm-12">
								<textarea name="message" id="message" class="form-control" rows="10" style="max-width: 100%" placeholder="Üzeneted" required>{{ old('message') }}</textarea>
							</div>
							<div class="col-sm-12" style="margin: 10px 0">
								{!! \Recaptcha::render() !!}
							</div>
							<div class="col-sm-12">
								{{ csrf_field() }}
								<button type="submit" style="margin-bottom: 10px" class="btn btn-primary btn-lg">Levélküldés</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
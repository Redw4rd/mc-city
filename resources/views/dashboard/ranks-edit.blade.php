@extends('layouts.dashboard')

@section('pagetitle')
	@if ($post != 'null')
		Rang szerkesztése
	@else
		Rang létrehozás
	@endif
@stop

@push('header_css')
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
@endpush

@section('page')
	<form action="" method="post">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="control-label">Rang megnevezése: </label>
					<input type="text" name="name" class="form-control" value="@if($post != 'null'){{$post->name}}@else{{old('name')}}@endif">
					@if($errors->has('name'))
						<span class="help-block">{{ $errors->first('name') }}</span>
					@endif
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
					<label for="group" class="control-label">Rang csoport: </label>
					<input type="text" name="group" class="form-control" value="@if($post != 'null'){{$post->group}}@else{{old('group')}}@endif">
					@if($errors->has('group'))
						<span class="help-block">{{ $errors->first('group') }}</span>
					@endif
				</div>
			</div>
		</div>

		<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
			<textarea name="description" id="description" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Rang leírása">@if($post != 'null') {!! $post->description !!} @else {{ old('description') }} @endif</textarea>
			@if($errors->has('description'))
				<span class="help-block">{{ $errors->first('description') }}</span>
			@endif
		</div>

		<div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
			<label for="color" class="control-label">Szín: </label>
			<input type="text" name="color" id="color" class="form-control" value="@if($post != 'null'){{$post->color}}@else{{old('color')}}@endif">
			@if($errors->has('color'))
				<span class="help-block">{{ $errors->first('color') }}</span>
			@endif
		</div>

		<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
				<label for="price" class="control-label">Rang ára: </label>
			<div class="input-group input-group-sm">
				<input type="text" name="price" class="form-control" value="@if($post != 'null'){{$post->price}}@else{{old('price')}}@endif">
				<span class="input-group-addon">Pixel</span>
			</div>
			@if($errors->has('price'))
				<span class="help-block">{{ $errors->first('price') }}</span>
			@endif
		</div>
		
		@if($post != 'null')
		{{ method_field('PUT') }}
		@endif
		{{ csrf_field() }}
		<div class="pull-left">
			<button type="submit" class="btn btn-primary">Rang mentése</button>
		</div>
	</form>
@stop

@push('footer_js')
	<script type="text/javascript" src="{{ asset('js/colorpicker.js') }}"></script>
	<script src="js/tinymce/tinymce.min.js"></script>
	<script>
		$(document).ready(function() {
			tinymce.init({
				selector: 'textarea',
				language: 'hu_HU',
				height: 300,
				cleanup: true,
				verify_html: false,
				statusbar: false,
				browser_spellcheck: true,
				entity_encoding : "raw",
				plugins: [
					'advlist autolink lists link image charmap preview anchor',
					'searchreplace visualblocks code fullscreen',
					'insertdatetime media table contextmenu paste code textcolor'
				],
				menubar: 'edit insert view format table tools',
				toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
				content_css: [
					'css/bootstrap.min.css',
					'css/style.css'
				]
			});
		});

		$('input#color').ColorPicker({
			@if($post->color)
			color: '{{ $post->color }}',
			@endif
			onChange: function (hsb, hex, rgb) {
				$('#color').val('#' + hex);
			}
		});
	</script>
@endpush
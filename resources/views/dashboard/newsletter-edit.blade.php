@extends('layouts.dashboard')

@section('pagetitle')
	Hírlevél létrehozás
@stop

@section('page')
	<form action="" method="post">
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			<label for="name" class="control-label">Hírlevél neve: </label>
			<input type="text" name="name" class="form-control" value="{{ old('name') }}">
			@if($errors->has('name'))
				<span class="help-block">{{ $errors->first('name') }}</span>
			@endif
		</div>

		<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
			<textarea name="content" id="body" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Tartalom">{{ old('content') }}</textarea>
			@if($errors->has('content'))
				<span class="help-block">{{ $errors->first('content') }}</span>
			@endif
		</div>

		{{ csrf_field() }}
		<div class="pull-left">
			<button type="submit" class="btn btn-primary">Hírlevél mentése</button>
		</div>
	</form>
@stop

@push('footer_js')
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
	</script>
@endpush
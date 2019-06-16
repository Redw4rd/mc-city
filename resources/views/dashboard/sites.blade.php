@extends('layouts.dashboard')

@section('pagetitle')
	{{ $page['name'] or 'Ismeretlen' }} oldal szerkesztése
@stop

@section('page')
	<form action="" method="post">
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			<label for="name" class="control-label">Oldal megjelenítendő neve </label>
			<input type="text" name="name" class="form-control" value="{{ $page['name'] }}">
			@if($errors->has('name'))
				<span class="help-block">{{ $errors->first('name') }}</span>
			@endif
		</div>
		
		<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
			<label for="body" class="control-label">Oldal tartalma: </label>
			<textarea name="body" id="" cols="30" rows="10">{!! $page['body'] !!}</textarea>
			@if($errors->has('body'))
				<span class="help-block">{{ $errors->first('body') }}</span>
			@endif
		</div>

		{{ csrf_field() }}
		<input type="hidden" name="slug" value="{{ $page['slug'] }}">
		<button type="submit" class="btn btn-primary">Oldal mentése</button>
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
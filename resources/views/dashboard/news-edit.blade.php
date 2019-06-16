@extends('layouts.dashboard')

@section('pagetitle')
	@if ($post != 'null')
		Hír szerkesztése
	@else
		Hír létrehozás
	@endif
@stop

@section('page')
	<form action="" method="post">
		<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="title" class="control-label">Hír címe: </label>
			<input type="text" name="title" class="form-control title" value="@if($post != 'null') {{ $post->title }} @else {{ old('title') }} @endif">
			@if($errors->has('title'))
				<span class="help-block">{{ $errors->first('title') }}</span>
			@endif
		</div>

		<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
			<label for="slug" class="control-label">Elérési útvonal: </label>
			<input type="text" name="slug" class="form-control slug" value="@if($post != 'null') {{ $post->slug }} @else {{ old('slug') }} @endif">
			@if($errors->has('slug'))
				<span class="help-block">{{ $errors->first('slug') }}</span>
			@endif
		</div>

		<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
			<textarea name="body" id="body" cols="30" rows="10" class="form-control full-width" style="max-width: 100%; min-width: 100%; height: 100px" placeholder="Tartalom">@if($post != 'null') {!! $post->body !!} @else {{ old('body') }} @endif</textarea>
			@if($errors->has('body'))
				<span class="help-block">{{ $errors->first('body') }}</span>
			@endif
		</div>
		
		@if($post != 'null')
		{{ method_field('PUT') }}
		@endif
		{{ csrf_field() }}
		<div class="pull-left">
			<button type="submit" class="btn btn-primary">Hír mentése</button>
			@if($post != 'null')
			<small>Utoljára szerkesztve: {{ date('Y, F d H:i', strtotime($post->updated_at)) }}</small>
			@endif
		</div>
	</form>
@stop

@push('footer_js')
	<script src="js/url_slug.js"></script>
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

			$(".title").keyup(function(){

				var slug = url_slug($(this).val(), {
			    	'limit':255
			    });

			    $('.slug').val(slug);
			      
			});
		});
	</script>
@endpush
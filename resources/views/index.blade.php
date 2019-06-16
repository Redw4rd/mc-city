@extends('layouts.frontend')
@section('jumbotron')
	@include('partials.jumbotron')
@stop
@section('page')
	<div class="panel panel-default">
		<div class="panel-heading">Hírek</div>
		<div class="panel-body">
		@forelse($news as $post)
			<article class="news">
				<header class="article-title">{{ $post->title }}</header>
				<section class="article-body">
					{!! $post->body !!}
				</section>
				<footer class="article-footer"><small class="label label-primary">Írta: {{ $post->user->username }}</small><small class="label label-primary">Publikálva: {{ date('Y, F d H:i', strtotime($post->created_at)) }}</small></footer>
			</article>
		@empty
			Nincs megjelenítendő hír az adatbázisban!
		@endforelse

		<div style="text-align: center; margin-top: 20px">{{ $news->links() }}</div>
		</div>
	</div>
@stop

@if(Auth::check())
@section('sidebar')
	<div class="panel panel-default">
		<div class="panel-heading">Felhasználói adatok</div>
		<div class="panel-body">
			<div class="col-sm-4">
				{!! Auth::user()->getAvatarImage(80, 'thumbnail') !!}
			</div>
			<div class="col-sm-8 user-data">
				<span class="fa fa-user"></span> {{ Auth::user()->getNameOrUsername() }} <br>
				<span class="fa fa-gamepad"></span> {{ Auth::user()->getRankName() }} <br>
			@if(Auth::user()->hasRank())
				<span class="fa fa-calendar"></span> Rang lejárata: {{ date('Y.m.d', strtotime(Auth::user()->rank_expire)) }}<br>
			@endif
				<span class="fa fa-paypal"></span> {{ number_format(Auth::user()->wallet, 0, '', ',') }} Pixel<br>
				<span class="fa fa-clock-o"></span> {{ date('Y, F d H:i', strtotime(Auth::user()->created_at)) }}
			</div>
			<div class="col-sm-12">
				<div class="btn-group btn-group-justified">
					<a href="{{ route('profile') }}" class="btn btn-primary" title="Beállítások"><span class="fa fa-cog"></span> Beállítások</a>
					<a href="{{ route('modify-password') }}" class="btn btn-primary" title="Jelszó módosítás"><span class="fa fa-unlock"></span> Jelszó módosítás</a>
				</div>
	
			</div>
			<div class="col-sm-12" style="margin-top: 20px">
				<div class="well">
					<figure class="skin-preview" data-minecraft-username="{{ Auth::user()->username }}"></figure>
				</div>
				@if(Auth::user()->hasSkin() !== false)
				<form action="{{ action('UploadController@removeSkin') }}" method="post">
					{{ csrf_field() }}
					<button style="margin-bottom: 10px" name="delete" value="skin" class="btn btn-danger btn-group-justified btn-file" type="submit" title="Skin törlése"><span class="fa fa-trash"></span> Skin törlése</button>
				</form>
				@endif
				<form action="{{ action('UploadController@skin') }}" method="post" class="skin-upload" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="btn-group btn-group-justified">
						<div class="btn btn-primary btn-file">
								<span class="fa fa-upload"></span> Skin feltöltése
								<input type="file" name="skin" id="skin" title="Skin feltöltés" required>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
@endif

@push('footer_js')
	<script src="js/jquery.minecraftskin.js"></script>
	<script>
		$(document).ready(function() {
			$('input[type=file]').change(function() {
			    $('form.skin-upload').submit();
			});
		});

		$(".skin-preview").minecraftSkin({scale: 6, hat: true, skinsrequest: '{{ route('index') }}/files/skins/' });
	</script>
@endpush
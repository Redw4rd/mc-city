@inject('Carbon', '\Carbon\Carbon')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $site['title'] }}</title>
	<base href="{{ route('index') }}/">

	<link rel="shortcut icon" href="images/favicon.png" type="image/png">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="keywords" content="{{ $site['keywords'] }}">
	<meta name="description" content="{{ $site['description'] }}">

	<meta property="og:type" content="website">
	<meta property="og:title" content="{{ $site['title'] }}">
	<meta property="og:description" content="{{ $site['description'] }}">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	@stack('header_css')
	<link rel="stylesheet" href="css/style.css">

	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	@stack('header_js')
</head>
<body>
	<header id="header">
		@include('partials.menu')
	</header>
	<div class="clearfix"></div>
	@hasSection('jumbotron')
		@yield('jumbotron')
		<div class="clearfix" style="margin-bottom: 20px"></div>
	@endif
	@yield('background')
	<div class="container">
		<div class="row">
		@include('flash::message')
		@hasSection('sidebar')
			<div class="col-md-8 col-sm-7 col-xs-12">
				@yield('page')
			</div>
			<div class="col-md-4 col-sm-5 col-xs-12">
				@yield('sidebar')
			</div>
		@else
			<div class="col-md-12 col-sm-12 col-xs-12">
				@yield('page')
			</div>
		@endif
		</div>
	</div>
	<div class="clearfix"></div>
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12 footer-column text-center-xs">
					<h3>Közösség</h3>
					<ul class="footer-menu">
						<li><a href="{{ $site['social_facebook_link'] }}">Facebook</a></li>
						<li><a href="{{ $site['social_youtube_link'] }}">Youtube</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 footer-column text-center-xs">
					<h3>Linkek</h3>
					<ul class="footer-menu">
						<li><a href="{{ route('donation') }}">Támogatás</a></li>
						<li><a href="{{ route('registration') }}">Regisztráció</a></li>
						<li><a href="{{ route('contact') }}">Kapcsolat</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 footer-column text-center-xs">
					<h3>Információ</h3>
					<ul class="footer-menu">
						<li><a href="{{ route('site', 'aszf') }}">Általános Szerződési Feltételek</a></li>
						<li><a href="{{ route('site', 'aff') }}">Általános Felhasználási Feltételek</a></li>
						<li><a href="{{ route('site', 'szabalyzat') }}">Szabályzat</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 footer-column text-center-xs">
					<h3>Státusz</h3>
					<div class="server-status">
						<div class="server-online">
							Szerver állapota: <div class="label label-danger">Offline</div>
						</div>
						<div class="server-players">
							Játékosok: <div class="label label-danger">N/A</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="copyright">Copyright &copy; PixelHero 2016 @if($Carbon::now() != $Carbon::createFromDate(2016))- {{ $Carbon::now()->year }} @endif | Coded &amp; designed by <a target="_blank" href="https://fb.me/bigors.gabor" style="color: #3498db; text-decoration:none">Redy</a> | <small>Render: {{ round((microtime(true) - LARAVEL_START), 2) }}s</small></div>
			</div>
		</div>
	</footer>

	<div id="cookie_alert">
		<span>Az oldal sütiket használ a barátságos és hatékony kezelhetőség érdekében!</span>
		<button class="btn btn-success btn-sm">Megértettem</button>
	</div>
	<script src="js/global.js"></script>
	<script src="js/jumbotron.js"></script>
	<script src="https://mcapi.us/scripts/minecraft.js"></script>
	<script>
		MinecraftAPI.getServerStatus('{{ env('MC_SERVER_IP', '') }}', {
			port: {{ env('MC_SERVER_PORT', '') }}
		}, function (err, status) {

		document.querySelector('.server-online').innerHTML = status.status == "success" ? 'Szerver állapota: <span class="label label-success">Online</span>' : 'Szerver állapota: <span class="label label-danger">Offline</span>';

		if (status.players.now == 0 || status.players.now == status.players.max) {
			document.querySelector('.server-players').innerHTML = 'Játékosok: <span class="label label-warning">'+ status.players.now +'/'+ status.players.max +'</span>';
		} else {
			document.querySelector('.server-players').innerHTML = 'Játékosok: <span class="label label-success">'+ status.players.now +'/'+ status.players.max +'</span>';
		}

	});
	</script>
	@stack('footer_js')
</body>
</html>
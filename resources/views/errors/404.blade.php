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
	<link rel="stylesheet" href="css/style.css">

	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="well">
			<section class="error-page">
			<div class="error-image col-sm-4 col-xs-3">
				<img src="images/endergirl.png" class="img-responsive" alt="EnderGirl">
			</div>
			<div class="error-message col-sm-8 col-xs-9">
				<h1>404</h1>
				<p>Az általad keresett oldal nem található!</p>
				<a href="{{ route('index') }}" class="btn btn-warning btn-lg"><span class="fa fa-reply"></span> Vissza a főoldalra</a>
			</div>
		</section>
		<div class="clearfix"></div>
		</div>
	</div>
</body>
</html>
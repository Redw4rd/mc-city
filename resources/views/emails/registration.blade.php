@extends('layouts.email')
@section('content')
	<h3>Kedves, {{ $mail['username'] }}!</h3>
	<br>
	Ezúton értesítelek, hogy sikeresen regisztráltál a {{ $site['title'] }} weboldalán. Fontos, hogy az oldalt, illetve a klienst csak azután tudod használni, miután megerősítetted a regisztrációdat!<br>
	<br>
	Az alábbi linkre kattintva megerősítheted regisztrációd: <a href="{{ route('account-verification', $mail['verify_token']) }}">{{ route('account-verification', $mail['verify_token']) }}</a><br>
	<br>
	Ha bármilyen problémád merül fel a jövőben, nyugodtan jelezd azt felénk hibajegyen, a weboldalon található kapcsolat menüponton, vagy Facebook üzeneten keresztül!<br>
	<br>
	További jó játékot kíván a <a href="{{ route('index') }}">PixelHero csapata!</a>
@stop
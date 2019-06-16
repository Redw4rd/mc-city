@extends('layouts.email')
@section('content')
	<h3>Kedves {{ $mail['username'] }}!</h3>

	<p>Te vagy valaki más jelszó módosítást szeretne végrehajtani a felhasználói fiókodon.
	Amennyiben nem te kérted a jelszvad módosítását, hagyd figyelmen kívül ezt az üzenetet.</p>

	<p>Ha te voltál a kérvényező, kérlek kattints az alábbi linkre: <br>
	<a href="{{ route('lost-password', $mail['token']) }}">{{ route('lost-password', $mail['token']) }}</a></p>
	<br>
	Ha bármilyen problémád merül fel a jövőben, nyugodtan jelezd azt felénk hibajegyen, a weboldalon található kapcsolat menüponton, vagy Facebook üzeneten keresztül!<br>
	<br>
	További jó játékot kíván a <a href="{{ route('index') }}">PixelHero csapata!</a>
@stop
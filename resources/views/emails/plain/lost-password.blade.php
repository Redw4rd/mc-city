Kedves {{ $mail['username'] }}!

Te vagy valaki más jelszó módosítást szeretne végrehajtani a felhasználói fiókodon. Amennyiben nem te kérted a jelszvad módosítását, hagyd figyelmen kívül ezt az üzenetet.

Ha te voltál a kérvényező, kérlek kattints az alábbi linkre:
{{ route('lost-password', $mail['token']) }}

Ha bármilyen problémád merül fel a jövőben, nyugodtan jelezd azt felénk hibajegyen, a weboldalon található kapcsolat menüponton, vagy Facebook üzeneten keresztül!

További jó játékot kíván a PixelHero csapata!

Weboldal: {{ route('index') }}
Leiratkozás: {{ route('unsubscribe') }}
Kapcsolatfelvétel: {{ route('contact') }}
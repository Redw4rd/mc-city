Kedves, {{ $mail['username'] }}!

Ezúton értesítelek, hogy sikeresen regisztráltál a {{ $site['title'] }} weboldalán. Fontos, hogy az oldalt, illetve a klienst csak azután tudod használni, miután megerősítetted a regisztrációdat!

Az alábbi linkre kattintva megerősítheted regisztrációd: {{ route('account-verification', $mail['verify_token']) }}

Ha bármilyen problémád merül fel a jövőben, nyugodtan jelezd azt felénk hibajegyen, a weboldalon található kapcsolat menüponton, vagy Facebook üzeneten keresztül!

További jó játékot kíván a PixelHero csapata!

Weboldal: {{ route('index') }}
Leiratkozás: {{ route('unsubscribe') }}
Kapcsolatfelvétel: {{ route('contact') }}
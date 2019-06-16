<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="{{ route('index') }}" class="navbar-brand">
				<span><img src="images/pixelhero-logo.png" /></span>
				{{ $site['title'] }}
			</a>
			<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation" area-expanded="false">
				<span class="sr-only">Menü megnyitása</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navigation">
			<ul class="nav navbar-nav navbar-right">
			{{-- Vendég által látható menüsor --}}
			<li>
				<a href="{{ route('index') }}">Főoldal</a>
			</li>
			<!--<li>
				<a href="{{ route('donation') }}">Támogatás</a>
			</li> nincs leskelődés, nincs-nincs... de ha már igen, támogass ;) -->
			<li>
				<a href="#" class="dropdown-toggle" style="position: relative;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					A Szerverről <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<!--<li><a href="{{ route('map') }}"><i class="fa fa-map"></i> Térkép</a></li>-->
					@if (Auth::check())
					<li><a href="http://s1.pixelhero.hu/dynmap/?username={{ Auth::user()->getNameOrUsername() }}"><i class="fa fa-map"></i> Térkép</a></li>
					@else
					<li><a href="http://s1.pixelhero.hu/dynmap/"><i class="fa fa-map"></i> Térkép</a></li>
					@endif
					<li><a href="{{ route('site', 'tortenet') }}"><i class="fa fa-book"></i> Történet</a></li>
				</ul>
			</li>
			<li>
				<a href="{{ route('downloads') }}">Letöltés</a>
			</li>
			<li>
				<a href="{{ route('contact') }}">Kapcsolat</a>
			</li>
			@if (Auth::check())
			<li>
				<a href="#" class="dropdown-toggle" style="position: relative;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="fa fa-user"></span>@if(Auth::user()->rank_id != 0) ({{ Auth::user()->getRankName() }}) @endif {{ Auth::user()->getNameOrUsername() }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					@if(Auth::user()->isAdmin())
						<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Kezelőfelület</a></li>
						<li class="divider"></li>
					@endif
					<li><a href="{{ route('profile') }}"><i class="fa fa-cog"></i> Beállítások</a></li>
					<li><a href="{{ route('modify-password') }}"><i class="fa fa-unlock-alt"></i> Jelszó módosítás</a></li>
					<li><a href="{{ route('activityLog') }}"><i class="fa fa-list"></i> Tevékenységek</a></li>
					<li class="divider"></li>
					<li><a href="{{ route('tickets') }}"><i class="fa fa-ticket"></i> Hibajegyeim</a></li>
					<li class="divider"></li>
					<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Kilépés</a></li>
				</ul>
			</li>
			<li><a href="{{ route('donation') }}"><span class="fa fa-paypal"></span> {{ number_format(Auth::user()->wallet, 0, '', ',') }} pixel</a></li>
			@else
				<li><a href="{{ route('login') }}"><i class="fa fa-user"></i> Bejelentkezés</a></li>
			@endif
			</ul>
		</div>
	</div>
</div>
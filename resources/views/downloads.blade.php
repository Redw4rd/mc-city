@extends('layouts.frontend')

@section('jumbotron')
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Letöltések</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="container">
		<div class="row">
			<div class="page-content downloads">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<figure class="os-logo">
								<i class="fa fa-windows"></i>
							</figure>
							<a href="{!! env('CLIENT_DOWNLOAD_LINK') !!}" class="btn btn-primary btn-lg btn-full">Letöltés Windows rendszerre</a>

							<ul class="list-group">
								<li class="list-group-item">
									<strong>Operációs Rendszer: </strong>Windows 7 vagy újabb
								</li>
								<li class="list-group-item">
									<strong>Processzor: </strong>Intel Pentium D vagy AMD Athlon 64 (K8) vagy jobb
								</li>
								<li class="list-group-item">
									<strong>RAM: </strong>Legalább 512MB szabad memória
								</li>
								<li class="list-group-item">
									<strong>GPU: </strong>Nvidia GeForce 9600 GT vagy AMD Radeon HD 2400 vagy újabb kártya, OpenGL 3.1 támogatással
								</li>
								<li class="list-group-item">
									<strong>HDD: </strong>Legalább 500 MB szabad terület
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</div>
@stop
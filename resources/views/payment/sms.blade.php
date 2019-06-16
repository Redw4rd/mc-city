@extends('layouts.frontend')

@push('header_css')
	<style>
		ul.nav-tabs {
			
		}
		ul.nav-tabs li {  }
		.tab-content {
			margin-top: 20px;
		}
		.panel ul {
			padding-left: 10px;
		}
	</style>
@endpush

@section('jumbotron')
	<div class="jumbotron jumbotron-heading">
		<div class="jumbotron-background">
			<div class="jumbotron-overlay"></div>
		</div>
		<div class="container">
			<div class="page-heading">
				<h1>Fizetés Emelt Díjas SMS-el</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#magyarorszag" aria-controls="magyarorszag" role="tab" data-toggle="tab">Magyarország</a></li>
					<li role="presentation"><a href="#romania" aria-controls="romania" role="tab" data-toggle="tab">Románia</a></li>
					<li role="presentation"><a href="#szerbia" aria-controls="szerbia" role="tab" data-toggle="tab">Szerbia</a></li>
					<li role="presentation"><a href="#szlovakia" aria-controls="szlovakia" role="tab" data-toggle="tab">Szlovákia</a></li>
				</ul>
			</div>
			
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="magyarorszag">
					<div class="col-md-8">
						<table class="table table-striped table-hover">
							<thead class="thead" style="font-weight: bold">
								<tr>
									<td>Telefonszám</td>
									<td>Pixel</td>
									<td>Ár (Bruttó)</td>
									<td>Üzenet</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>06-90-444-110</td>
									<td>400 Pixel</td>
									<td>205 Ft</td>
									<td>PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
								<tr>
									<td>06-90-642-123</td>
									<td>600 Pixel</td>
									<td>330 Ft</td>
									<td>PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
								<tr>
									<td>06-90-643-123</td>
									<td>1000 Pixel</td>
									<td>508 Ft</td>
									<td>PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
								<tr>
									<td>06-90-888-340</td>
									<td>2000 Pixel</td>
									<td>1016 Ft</td>
									<td>PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
								<tr>
									<td>06-90-888-460</td>
									<td>4000 Pixel</td>
									<td>2032 Ft</td>
									<td>PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
								<tr>
									<td>06-90-649-123</td>
									<td>10000 Pixel</td>
									<td>5080 Ft</td>
									<td>PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-4">
						<div class="panel panel-primary">
							<div class="panel-heading">FONTOS!</div>
							<div class="panel-body">
								<ul>
									<li>A félreküldött és/vagy elírt SMS-ek feldolgozásáért <strong>felelősséget nem vállalunk</strong>!</li>
									<li>Minden megjelenített ár bruttó ár, vagyis <strong>tartalmazzák</strong> az adott országban értendő <strong>ÁFA értékét</strong>.</li>
									<li><strong>Problémák esetén nyiss egy hibajegyet.</strong> Csapatunk rendelkezésedre áll, ha segítségről van szó!</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="romania">
					<div class="col-md-8">
						<table class="table table-striped table-hover">
							<thead class="thead" style="font-weight: bold">
								<tr>
									<td>Telefonszám</td>
									<td>Pixel</td>
									<td>Ár (Bruttó)</td>
									<td>Üzenet</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>7472 (Vodafone és Orange hálózatokról)</td>
									<td>6000 Pixel</td>
									<td>9,6 EUR</td>
									<td>IFT PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
								<tr>
									<td>7208 (Cosmo hálózatról)</td>
									<td>6000 Pixel</td>
									<td>9,6 EUR</td>
									<td>IFT PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-4">
						<div class="panel panel-primary">
							<div class="panel-heading">FONTOS!</div>
							<div class="panel-body">
								<ul>
									<li>A félreküldött és/vagy elírt SMS-ek feldolgozásáért <strong>felelősséget nem vállalunk</strong>!</li>
									<li>Minden megjelenített ár bruttó ár, vagyis <strong>tartalmazzák</strong> az adott országban értendő <strong>ÁFA értékét</strong>.</li>
									<li><strong>Problémák esetén nyiss egy hibajegyet.</strong> Csapatunk rendelkezésedre áll, ha segítségről van szó!</li>
									<li>A <strong>Romániában</strong> használatos <strong>7472</strong>-es telefonszámra csak <strong>Vodafone</strong> és <strong>Orange</strong>, a <strong>7208</strong>-as telefonszámra pedig csak a <strong>Cosmo</strong> hálózatokról fogadunk üzeneteket!</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="szerbia">
					<div class="col-md-8">
						<table class="table table-striped table-hover">
							<thead class="thead" style="font-weight: bold">
								<tr>
									<td>Telefonszám</td>
									<td>Pixel</td>
									<td>Ár (Bruttó)</td>
									<td>Üzenet</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>2882</td>
									<td>4000 Pixel</td>
									<td>840 RSD</td>
									<td>IFT PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-4">
						<div class="panel panel-primary">
							<div class="panel-heading">FONTOS!</div>
							<div class="panel-body">
								<ul>
									<li>A félreküldött és/vagy elírt SMS-ek feldolgozásáért <strong>felelősséget nem vállalunk</strong>!</li>
									<li>Minden megjelenített ár bruttó ár, vagyis <strong>tartalmazzák</strong> az adott országban értendő <strong>ÁFA értékét</strong>.</li>
									<li><strong>Problémák esetén nyiss egy hibajegyet.</strong> Csapatunk rendelkezésedre áll, ha segítségről van szó!</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="szlovakia">
					<div class="col-md-8">
						<table class="table table-striped table-hover">
							<thead class="thead" style="font-weight: bold">
								<tr>
									<td>Telefonszám</td>
									<td>Pixel</td>
									<td>Ár (Bruttó)</td>
									<td>Üzenet</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>7401</td>
									<td>2000 Pixel</td>
									<td>3 EUR</td>
									<td>IFT PIXELHERO {{ \Auth::user()->username }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-4">
						<div class="panel panel-primary">
							<div class="panel-heading">FONTOS!</div>
							<div class="panel-body">
								<ul>
									<li>A félreküldött és/vagy elírt SMS-ek feldolgozásáért <strong>felelősséget nem vállalunk</strong>!</li>
									<li>Minden megjelenített ár bruttó ár, vagyis <strong>tartalmazzák</strong> az adott országban értendő <strong>ÁFA értékét</strong>.</li>
									<li><strong>Problémák esetén nyiss egy hibajegyet.</strong> Csapatunk rendelkezésedre áll, ha segítségről van szó!</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="row text-center" style="padding: 10px 0">
			Elérhetőségünk: info@pixelhero.hu | Az emelt díjas szolgáltatást biztosítja: InFo-Tech 2006 Bt | Web: www.info-tech.hu | E-mail: info@info-tech.hu
		</div>
	</div>
@stop
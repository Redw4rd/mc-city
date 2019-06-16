@extends('layouts.frontend')
@push('header_css')
	<style>
		div[class$='-big'] {
			line-height: 1em;
			font-size: 300%;
		}
		.panel {
			max-width: 300px;
		}
		.panel-default .panel-heading {
			color: #ffffff;
			text-shadow: 0px 1px 1px #000;
		}
		.panel-heading,
		.panel-body {
			text-align: center;
		}

		.btn {
			margin-top: 20px;
		}

		.flex {
			display: inline-flex;
			flex-flow: row wrap;
			align-items: flex-start;
			justify-content: space-around;
		}

		.flex-item {
			display: inline-block;
			margin: 5px;
			flex: 1 100%;
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
				<h1>Támogatás</h1>
			</div>
		</div>
	</div>
@stop

@section('page')
	<div class="btn-group btn-group-justified">
		<a href="{{ route('donation.paypal') }}" class="btn btn-primary">
			<div class="fa fa-paypal hidden-sm" style="font-size: 200%; vertical-align: middle;"></div>
			<span style="font-size: 150%; vertical-align: middle;" class="hidden-xs">Vásárolj Pixelt PayPallal</span>
		</a>
		<a href="{{ route('donation.sms') }}" class="btn btn-warning">
			<div class="fa fa-commenting-o hidden-sm" style="font-size: 200%; vertical-align: middle;"></div>
			<span style="font-size: 150%; vertical-align: middle;" class="hidden-xs">Vásárolj Pixelt emelt díjas SMS-el</span>
		</a>
	</div>
	<div class="flex" style="margin-top: 20px">
		@forelse($ranks as $rank)
			<div class="panel panel-default flex-item">
				<div class="panel-heading"@if($rank->color) style="background-color: {{ $rank->color }}" @endif>
					<div class="rank-name-big">{{ $rank->name }}</div>
					<div class="rank-price-big">@if($rank->price >0 ){{ number_format($rank->price, 0, '', ',') }} Pixel @else Ingyenes @endif</div>
				</div>
				<div class="panel-body">
					<div class="rank-description">
						{!! $rank->description !!}
					</div>

					@if($rank->price > 0)
						<button data-rank-name="{{ $rank->name }}" data-rank-price="{{ $rank->price }}" data-href="{{ route('donation.process', $rank->id) }}" class="btn btn-primary rankBuy"><span class="fa fa-shopping-cart"></span> Vásárlás</button>
					@endif
				</div>
			</div>
		@empty
			Az adminisztrátor még nem állította be a rangokat!
		@endforelse
	</div>
	<img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" style="display: block; margin: 20px auto" alt="Credit Card Badges">
@stop
@push('footer_js');
	@if(\Auth::user())
	<script>
		$('.rankBuy').click(function(){
			if ({{ \Auth::user()->rank_id }} != 0) {
				if (confirm('Biztosan le szeretnéd cerélni a kelenlegi ({{ \Auth::user()->getRankName() }}) a ' + $(this).data('rank-name') + ' rangért cserébe? (Az előző rag teljesen elveszik)')) {
					window.location.replace($(this).data('href'));
				} else {
					return false;
				}
			} else {
				if (confirm('Biztosan meg akarod vásárolni a ' + $(this).data('rank-name') + ' rangot ' + $(this).data('rank-price') + ' Pixelért?')) {
					window.location.replace($(this).data('href'));
				} else {
					return false;
				}
			}
		});
	</script>
	@else
	<script>
		$('.rankBuy').click(function(){
			alert('Rang vásárláshoz be kell jelentkezned!');			
		});
	</script>
	@endif
@endpush
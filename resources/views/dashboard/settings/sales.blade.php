@extends('layouts.dashboard')

@section('pagetitle')
	Akciók
@stop

@section('page')
	<form action="" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading">PayPal</div>
			<div class="panel-body">
				<div class="form-group{{ $errors->has('paypal_discount') ? ' has-error' : '' }}">
					<label for="paypal_discount" class="control-label">PayPal extra pont</label>
					<div class="input-group input-group-sm">
						<input type="text" name="paypal_discount" class="form-control" value="{{ $site['paypal_discount'] }}">
						<div class="input-group-addon">%</div>
					</div>
					<small id="emailHelp" class="form-text text-muted">Ennyi %-al kap több PixelPontot a vásárló, ha a PayPal fizetési módot választja</small>
					@if($errors->has('paypal_discount'))
						<span class="help-block">{{ $errors->first('paypal_discount') }}</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('paypal_min_amount') ? ' has-error' : '' }}">
					<label for="paypal_min_amount" class="control-label">Minimum PixelPont</label>
					<div class="input-group input-group-sm">
						<input type="text" name="paypal_min_amount" class="form-control" value="{{ $site['paypal_min_amount'] }}">
						<div class="input-group-addon">Pixel</div>
					</div>
					<small id="emailHelp" class="form-text text-muted">Ez a minimum PixelPont szám amit meg tudnak vásárolni</small>
					@if($errors->has('paypal_min_amount'))
						<span class="help-block">{{ $errors->first('paypal_min_amount') }}</span>
					@endif
				</div>
			</div>
		</div>

		{{ csrf_field() }}
		<button type="submit" class="btn btn-primary">Mentés</button>
	</form>
@stop
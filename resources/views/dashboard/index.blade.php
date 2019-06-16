@extends('layouts.dashboard')

@section('pagetitle')
	Kezelőfelület
@stop

@section('page')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ \App\User::all()->count() }}</div>
                        <div>Regisztrált felhasználó</div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span class="pull-right">
                    <a href="{{ route('users') }}">Felhasználók listája <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-newspaper-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ \App\News::all()->count() }}</div>
                        <div>Mentett hír</div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span class="pull-right">
                    <a href="{{ route('dashboard.news') }}">Hírek kezelése <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-paypal fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ \App\User::where('rank_id', '!=', 0)->count() }}</div>
                        <div>Támogató</div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span class="pull-right">
                    <a href="{{ route('settings.sales') }}">PayPal beállítás <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-ticket fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{ \App\Tickets::all()->count() }}</div>
                        <div>Hibajegy</div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span class="pull-right">
                    <a href="{{ route('dashboard.tickets') }}">Tovább a hibajegyekhez <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
                </span>
            </div>
        </div>
    </div>
</div>
@stop
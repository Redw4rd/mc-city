<?php

namespace App\Providers;

use Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	if( ini_get( 'wincache.ocenabled' ) )
		{
		    ini_set( 'wincache.ocenabled', '0' );
        }
    	
        $PageSettings = Array();
        
        foreach(\App\PageSettings::all() as $row => $col) {
            $PageSettings[$col->key] = $col->value;
        }

        \View::share('site', $PageSettings);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

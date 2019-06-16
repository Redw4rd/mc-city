<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::group('', ['middleware' => 'auth'], function() {

});*/

Route::group(['middleware' => 'AuthAfter'], function() {

	Route::get('/bejelentkezes', [
		'uses' => 'AuthController@login',
		'as' => 'login'
	]);
	Route::post('/bejelentkezes', [
		'uses' => 'AuthController@postLogin',
		'middleware' => 'throttle:5,1'
	]);

	Route::get('/regisztracio', [
		'uses' => 'AuthController@registration',
		'as' => 'registration'
	]);
	Route::post('/regisztracio', 'AuthController@postRegistration');

	Route::get('/elfelejtett-jelszo/{token?}', [
		'uses' => 'AuthController@password_reset',
		'as' => 'lost-password'
	]);
	Route::post('/elfelejtett-jelszo/{token?}', 'AuthController@postPassword_reset');

	Route::get('/megerosites/{verify_token}', [
		'uses' => 'AuthController@accountVerification',
		'as' => 'account-verification'
	]);

});

Route::get('/leiratkozas', [
	'uses' => 'AuthController@unsubscribe',
	'as' => 'unsubscribe'
]);
Route::post('/leiratkozas', ['uses' => 'AuthController@postUnsubscribe']);

Route::group(['middleware' => 'auth'], function() {

	Route::get('/profil', [
		'uses' => 'UserController@profile',
		'as' => 'profile'
	]);
	Route::post('/profil', ['uses' => 'UserController@postProfile']);

	Route::get('/profil/tevekenysegeim', [
		'uses' => 'UserController@activityLog',
		'as' => 'activityLog'
	]);

	Route::get('/jelszo-modositas', [
		'uses' => 'UserController@resetPassword',
		'as' => 'modify-password'
	]);
	Route::post('/jelszo-modositas', 'UserController@postResetPassword');

	Route::get('/hibajegyek/{ticket_id?}', [
		'uses' => 'UserController@tickets',
		'as' => 'tickets'
	]);
	Route::post('/hibajegyek', ['uses' => 'UserController@postTicket']);
	Route::put('/hibajegyek/{ticket_id?}', ['uses' => 'UserController@sendTicketMessage']);

	Route::get('/kijelentkezes', function() {
		activity('Azonosítás')->log('Kijelentkezés a weboldalról');
		Auth::logout();
		return Redirect::to(route('index'));
	})->name('logout');


	Route::post('skin-feltoltes', ['uses' => 'UploadController@skin']);
	Route::post('skin-torles', ['uses' => 'UploadController@removeSkin']);

	
	Route::get('/tamogatas/paypal', [
		'uses' => 'HomeController@paypal',
		'as' => 'donation.paypal'
	]);
	Route::get('/tamogatas/paypal/success', [
		'uses' => 'PaypalPaymentController@getSuccessPayment',
		'as' => 'donation.paypal.success'
	]);
	Route::post('/tamogatas/paypal', ['uses' => 'PaypalPaymentController@postPayment']);

	Route::get('/tamogatas/sms', [
		'uses' => 'HomeController@sms',
		'as' => 'donation.sms'
	]);

	Route::get('/tamogatas/process/{rank}', [
		'uses' => 'PaymentController@processPurchase',
		'as' => 'donation.process'
	]);
});

Route::get('/tamogatas/sms/process', [
	'uses' => 'SMSPaymentController@getPayment',
	'as' => 'donation.sms.process'
]);

Route::get('/', [
	'uses' => 'HomeController@index',
	'as' => 'index'
]);

Route::get('/kapcsolat', [
	'uses' => 'HomeController@contact',
	'as' => 'contact'
]);
Route::post('/kapcsolat', 'HomeController@postContact');

Route::get('/letoltes', [
	'uses' => 'HomeController@downloads',
	'as' => 'downloads'
]);

Route::get('/terkep', [
	'uses' => 'HomeController@map',
	'as' => 'map'
]);

Route::get('/tamogatas', [
	'uses' => 'HomeController@donation',
	'as' => 'donation'
]);

Route::get('/oldal/{slug}', [
	'uses' => 'HomeController@sites',
	'as' => 'site'
]);


Route::group(['prefix' => 'dashboard', 'middleware' => \App\Http\Middleware\IsAdminMiddleware::class], function() {

	Route::get('/', [
		'uses' => 'DashboardController@index',
		'as' => 'dashboard'
	]);

	Route::get('/beallitasok', [
		'uses' => 'DashboardController@settings_site',
		'as' => 'settings.site'
	]);
	Route::post('/beallitasok', ['uses' => 'DashboardController@postSettings_site']);

	Route::get('/beallitasok/learazasok', [
		'uses' => 'DashboardController@settings_sales',
		'as' => 'settings.sales'
	]);
	Route::post('/beallitasok/learazasok', ['uses' => 'DashboardController@postSettings_sales']);

	Route::get('/oldal/{pagename?}', [
		'uses' => 'DashboardController@sites',
		'as' => 'sites'
	]);
	Route::post('/oldal/{pagename?}', ['uses' => 'DashboardController@postSites']);

	Route::get('/hibajegyek/{ticket_id?}', [
		'uses' => 'DashboardController@tickets',
		'as' => 'dashboard.tickets'
	]);
	Route::post('/hibajegyek/{ticket_id?}', ['uses' => 'DashboardController@lockTicket']);
	Route::put('/hibajegyek/{ticket_id?}', ['uses' => 'DashboardController@sendTicketMessage']);

	Route::get('/hirek/{news_id?}', [
		'uses' => 'DashboardController@news',
		'as' => 'dashboard.news'
	]);
	Route::post('/hirek/{news_id?}', ['uses' => 'DashboardController@postNews']);
	Route::put('/hirek/{news_id?}', ['uses' => 'DashboardController@putNews']);

	Route::get('/hirlevel/{id?}', [
		'uses' => 'DashboardController@newsletter',
		'as' => 'dashboard.newsletter'
	]);
	Route::post('/hirlevel/{id?}', ['uses' => 'DashboardController@postNewsletter']);
	Route::post('delete-newsletter', ['uses' => 'DashboardController@deleteNewsletter']);

	Route::get('/felhasznalok/{username?}', [
		'uses' => 'DashboardController@users',
		'as' => 'users'
	]);
	Route::post('/felhasznalok/{username?}', ['uses' => 'DashboardController@deleteUser']);
	Route::post('user-activate', ['uses' => 'DashboardController@activateUser']);
	Route::put('/felhasznalok/{username?}', ['uses' => 'DashboardController@updateUser']);

	Route::get('/rangok/{id?}', [
		'uses' => 'DashboardController@ranks',
		'as' => 'ranks'
	]);
	Route::post('/rangok/{id?}', ['uses' => 'DashboardController@postRanks']);
	Route::put('/rangok/{id?}', ['uses' => 'DashboardController@putRanks']);

	Route::get('/rendszer/log', [
		'uses' => 'DashboardController@Log',
		'as' => 'dashboard.log',
	]);

});


Route::group(['prefix' => 'api'], function() {
	Route::post('/login', ['uses' => 'APIController@login']);
	Route::post('/joinServer', ['uses' => 'APIController@joinServer']);
	Route::post('/checkPlayer', ['uses' => 'APIController@checkPlayer']);
});
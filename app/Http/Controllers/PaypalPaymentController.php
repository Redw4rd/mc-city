<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\PageSettings;

use PayPal;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Srmklive\PayPal\Services\ExpressCheckout;
//use Srmklive\PayPal\Services\AdaptivePayments;

class PaypalPaymentController extends Controller
{
    public function postPayment(Request $request)
    {
        if ($request->input('pixel') == NULL) {
        	\Flash::info('Nem töltötted ki a mezőt!');
            return redirect()->back();
        }

    	$site = Array();
    	foreach(PageSettings::all() as $row => $col) {
            $site[$col->key] = $col->value;
        }

    	$provider = PayPal::setProvider('express_checkout');

    	$tmp_price = (int) ceil(($request->input('pixel')/2)/(1+($site['paypal_discount']/100)));

    	$data = [
    		'items' => [
    			[
	    			'name' 	=> 'Pixel',
	    			'price' => (int) $tmp_price,
	    			'qty' 	=> 1
	    		]
    		],

    		'total' => $tmp_price,

    		'invoice_id' 			=> number_format(ceil(microtime(true)), 0, '', ''),
    		'invoice_description' 	=> $request->input('pixel') . ' Pixel vásárlás',
    		'return_url'			=> route('donation.paypal.success'),
    		'cancel_url'			=> route('index')
    	];

    	$response = $provider->setExpressCheckout($data);
		
		if(!array_key_exists('paypal_link', $response)) {
			\Flash::error('Nem sikerült a PayPalos fizetés! Kérjük próbáld meg újra, vagy amennyiben később is problémákba ütközöl, vedd fel velünk a kapcsolatot! Hibakód: 0');
			return redirect(route('donation'));
		}
		
    	return redirect($response['paypal_link']);
    }

    public function getSuccessPayment(Request $request)
    {
        $provider = PayPal::setProvider('express_checkout');

        $response = $provider->getExpressCheckoutDetails($request['token']);

        if ($response['ACK'] != "Success") {
            \Flash::error('Nem sikerült a PayPalos fizetés! Kérjük próbáld meg újra, vagy amennyiben később is problémákba ütközöl, vedd fel velünk a kapcsolatot! Hibakód: 1');
            return redirect(route('donation'));
        }

        $data = [
            'items' => [
                [
                    'name'  => $response['L_NAME0'],
                    'price' => $response['L_AMT0'],
                    'qty'   => $response['L_QTY0']
                ]
            ],

            'total' => $response['L_AMT0'],
            'invoice_id' => $response['INVNUM'],
            'invoice_description'   => $response['DESC'],
        ];

    	$response = $provider->doExpressCheckoutPayment($data, $request['token'], $request['PayerID']);

        if ($response['ACK'] == "Success") {
            $data['pixel'] = explode(' ', $data['invoice_description'])[0];

            $user = \Auth::user();
            $user->update([
                'wallet' => $user->wallet + $data['pixel']
            ]);

            activity('Vásárlás')->log($data['pixel'].' Pixel vásárlás ('.$data['total'].' Ft) PayPal fizetési eszközzel');

            \Flash::success('Köszönjük a vásárlást! A vásárolt Pixelek jóvárásra kerültek a fiókodban.');
            return redirect(route('donation'));
        } else {
            \Flash::error('Nem sikerült a PayPalos fizetés! Kérjük próbáld meg újra, vagy amennyiben később is problémákba ütközöl, vedd fel velünk a kapcsolatot! Hibakód: 2');
            return redirect(route('donation'));
        }
    }
}
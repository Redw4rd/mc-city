<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\smsTransactions;

class SMSPaymentController extends Controller
{
    public function getPayment(Request $request)
    {
    	if ($request->input('status') == 1) {

    		$categories = [
    			'2' 		=> 400,
    			'4' 		=> 600,
    			'6' 		=> 1000,
    			'9' 		=> 2000,
    			'11' 		=> 4000,
    			'15' 		=> 10000,
    			'840'		=> 4000,
    			'3'			=> 2000,
    			'9,6'	 	=> 6000
    		];

    		$data = [
    			'id' => $request->input('id'),
    			'kategoria' => $request->input('kategoria'),
    			'uzenet' => $request->input('uzenet'),
    		];

            $username = explode(' ', $request->input('uzenet'));

            $username = end($username);


    		$user = \App\User::where('username', $username)->first();

    		if (!$user) {
    			die("A megadott felhasználónév nem található! Vedd fel velünk a kapcsolatot! - PixelHero -");
    		}

    		smsTransactions::create([
    			'id' => $request->input('id'),
    			'user_id' => $user->id,
    			'given_pixel' => $categories[$request->input('kategoria')]
    		]);

    		activity('Vásárlás')->causedBy($user->id)->log($categories[$request->input('kategoria')].' Pixel vásárlás emelt díjas SMS-el');

    		die("A vásárlásod pár percen belül feldolgozásra kerül! - PixelHero -");
    	}

    	if ($request->input('status') == 2) {
    		if ($request->input('dlr') == 'DELIVRD') {
    			$sms = smsTransactions::where('id', $request->input('id'))->first();

    			$user = \App\User::where('id', $sms->user_id)->first();

    			$user->update([
                    'wallet' => $user->wallet + $sms->given_pixel
                ]);

    			activity('Vásárlás')->causedBy($user->id)->log($sms->given_pixel . ' Pixel jóváírva');
    		} else {
				activity('Vásárlás')->causedBy($user->id)->log('Sikertelen emelt díjas SMS feldolgozás');
			}

    		die("OK");
    	}


    }
}

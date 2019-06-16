<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PaymentController extends Controller
{
    public function processPurchase(Request $request, $rank)
    {
    	if (empty($rank) || !is_numeric($rank) || !$rank = \App\Ranks::find($rank)) {
    		\Flash::error('Ilyen rangot mi nem szolgáltatunk!');
    		return redirect(route('donation'));
    	}

    	$user = \Auth::user();

    	if ($user->wallet < $rank->price) {
    		\Flash::warning('Nincs elegendő Pixeled a rang megvásárlásához! Amennyiben szeretnéd ezt a rangot magadénak tudni 1 hónap időtartamig, kérlek vásárolj Pixelt az általunk feltüntetett lehetőségek eggyikével.');
    		return redirect(route('donation'));
    	}

    	$user->update([
    		'wallet' => (int) ($user->wallet - $rank->price),
    		'rank_id' => $rank->id,
    		'got_rank' => \Carbon\Carbon::now(),
    		'rank_expire' => \Carbon\Carbon::now()->addMonth(),
    	]);

    	activity('Vásárlás')->log('Megvásároltad a '. $rank->name .' rangot '. $rank->price . ' Pixel összegért');
    	\Flash::success('Köszönjük támogatásodat! Nagylelkűségedért megkaptad a '. $rank->name . ' rangot 1 hónap időtartamra.');
    	return redirect(route('index'));
    }
}

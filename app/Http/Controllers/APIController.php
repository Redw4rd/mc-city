<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class APIController extends Controller
{
    public function login(Request $request)
    {
    	// dd($request->all());

		if (\Auth::attempt([
			'email' => $request->input('email'),
			'password' => $request->input('password')]
		, false)) {
			$user = \App\User::where('email', $request->input('email'))->first();

			if (isset($user)){
				if (!is_null($user->verify_token)) {
					activity('Azonosítás')->causedBy($user->id)->log('Belépési kísérlet kliensen keresztül, nem megerőstett felhasználói fiókkal');
					return response()->json(['attempt' => 'not_verified']);
				}
			}

			$oldData = \App\clientSessions::where('username', \Auth::user()->username)->first();

			$clienthash = bcrypt(\Auth::user()->username . \Carbon\Carbon::now());

			$tempData = [
				'username' => \Auth::user()->username,
				'sessionID' => $clienthash,
				'serverHash' => ''
			];

			if ($oldData) {
				$oldData->update([
					'sessionID' => $clienthash,
					'serverHash' => ''
				]);
			} else {
				$session = new \App\clientSessions;
				$session->insert($tempData);
			}
			activity('Azonosítás')->causedBy($user->id)->log('Bejelentkezés a kliensből');
			return response()->json($tempData);
		} else {
			return response()->json(['attempt' => 'failed']);
		}
    }

    public function joinServer(Request $request)
    {
		// dd($request->all());

        $session = \App\clientSessions::where([
            'username' => $request->input('username'),
            'sessionID' => $request->input('sessionID')
        ])->first();

		if (!$session) {
        	return response()->json(['join' => 'failed']);
		}
		
        $user = \App\User::where('username', $session->username)->first();

        

        $session->update([
            'serverHash' => $request->input('serverHash')
        ]);

        activity('Szerver')->causedBy($user->id)->log('Szerver csatlakozási kérelem');
    }

    public function checkPlayer(Request $request)
    {
		if($request->input('serverHash') == '') {
			return response()->json(['isConnected' => false]);
		}
	
        $session = \App\clientSessions::where([
            'username' => $request->input('username'),
            'serverHash' => $request->input('serverHash')
        ])->first();

        if ($session) {
            $session->update([
                'serverHash' => null
            ]);

            $user = \App\User::where('username', $session->username)->first();

            activity('Szerver')->causedBy($user->id)->log('Sikeres bejelentkezés a szerverre');
			
            return response()->json([
            	'isConnected' => true,
            	'rank' => $user->rank_id == 0 ? null : $user->Rank()->group
            ]);
        } else {
            return response()->json(['isConnected' => false]);
        }
    }
}
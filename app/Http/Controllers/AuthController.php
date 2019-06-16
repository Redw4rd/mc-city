<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordResetRequest;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;


class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins, DispatchesJobs;

    protected $maxLoginAttempts = 3;
    protected $lockoutTime = 300;

	/**
	 * Login stuff
	 */
    public function login()
    {
        return View('login.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = \App\User::where('email', $request->input('email'))->first();

        if (isset($user)){
            
            if (!is_null($user->verify_token)) {
                \Flash::warning('Nem erősítetted meg a felhasználói fiókodat!');

                return redirect()->route('login');
            }
        }

        if (!\Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
            \Flash::error('Hibás belépési adatok');
            activity('Azonosítás')->log('Sikertelen belépési kísérlet');

            return redirect()->route('login');
        }

        activity('Azonosítás')->log('Bejelentkezés a weboldalról');

        return redirect()->route('index');
    }

    /**
     * Registration stuff
     */
    public function registration()
    {
        return View('login.registration');
    }

    public function postRegistration(RegistrationRequest $request)
    {	
        $user = [
            'username'  => $request->input('username'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
            'verify_token' => bin2hex(openssl_random_pseudo_bytes(16)),
			'subscribe_newsletter' => $request->input('newsletter') == 'on' ? 1 : 0,
			'avatar_image' => 'skin',
        ];

        \App\User::create($user);

        /**
         * E-mail küldés
         */
        \Mail::queue(['emails.registration', 'emails.plain.registration'], ['mail' => $user], function($m) use($user) {
            $m->to($user['email'], $user['username'])->subject('PixelHero email megerősítés');
        });

        \Flash::info('Sikeres regisztráció! Hamarosan kapni fogsz egy megerősítő e-mailt a megadott e-mail címre.');

        return redirect()->route('registration');
    }

    /**
     * Verification stuff
     */
    public function accountVerification(Request $request, $verify_token)
    {
        $user = \App\User::where('verify_token', $verify_token);

		//dd($user);
		
        $user_tmp = $user->first();

        if ($user->count()) {
            $user->update([
                'verify_token' => NULL
            ]);

            activity('Azonosítás')->causedBy($user_tmp->id)->log('Felhasználói fiók aktiválás');

            \Flash::info('A felhasználói fiókodat sikeresen aktiváltad. Most már be tudsz jelentkezni a felhasználói adataiddal.');

            return redirect()->route('index');
        }

        \Flash::warning('Hiba történt a fiók aktiválása során! Próbáld újra később.');

        return redirect()->route('login');
    }

    /**
     * Password stuff
     */
    public function password_reset(Request $request, $token=null)
    {
        $user = \App\User::where('reset_password_token', $token);

        if (!$user->count()) {
            $token = false;
        }

        return View('login.reset_password')->with([
            'withcode' => $token
        ]);
    }

    public function postPassword_reset(PasswordResetRequest $request)
    {
        if ($request->input('email')) {
            $user = \App\User::where('email', $request->input('email'));

            if (!$user->count()) {
                \Flash::warning('Az általad megadott e-mail cím nem szerepel az adatbázisban!');

                return redirect()->route('lost-password');
            }

            $token = bin2hex(openssl_random_pseudo_bytes(16));

            $user->update([
                'reset_password_token' => $token
            ]);

            $user = $user->first();

            activity('Azonosítás')->causedBy($user->id)->log('Jelszó módosítási kérelem e-mailben');

            /**
             * E-mail küldés
             */
            \Mail::queue(['emails.lost-password', 'emails.plain.lost-password'], ['mail' => ['username' => $user->username, 'token' => $token]], function($m) use($user) {
                $m->to($user->email, $user->username)->subject('Jelszó módosítási kérelem');
            });

            \Flash::info('A jelszó módosításhoz szükséges kódot elküldtük a megadott e-mail címre!');
        }

        if ($request->input('password')) {
            
            $user = \App\User::where('reset_password_token', $request->input('_password_reset'));

            $user->update([
                'password' => bcrypt($request->input('password')),
                'reset_password_token' => NULL
            ]);

            activity('Azonosítás')->log('Jelszó módosítás jelszóemlékeztető funkcióval');

            \Flash::success('A jelszavad megváltoztattuk, most már be tudsz jelentkezni az új jelszavaddal.');
        }

        return redirect()->route('lost-password');
    }

    public function unsubscribe()
    {
        return View('login.unsubscribe');
    }

    public function postUnsubscribe(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = \App\User::where('email', $request->input('email'));

        $user->update([
            'subscribe_newsletter' => false
        ]);

        activity('E-mail')->causedBy($user->id)->log('Leiratkozás a hírlevélről');

        \Flash::info('Sajnáljuk, hogy nem találtad érdekesnek hírlevelünket. :(');

        return redirect()->back();
    }
}

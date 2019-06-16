<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;
use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
        $news = \App\News::where('published', 1)->orderBy('id', 'DESC')->paginate(15);

    	return View('index')->with([
            'news' => $news
        ]);
    }

    public function contact()
    {
    	return View('contact')->with([
            'settings' => [
                'types' => explode('|', str_replace('-', ' ', env('CONTACT_TYPES')))
            ]
        ]);
    }

    public function postContact(ContactRequest $request)
    {
        $content = 'Feladó: '.$request->input('email').'<br>Üzenet: '.$request->input('message');

    	$user = [
    		'name' => $request->input('name'),
    		'email' => $request->input('email'),
    		'type' => $request->input('type'),
    		'content' => $content
    	];

    	\Mail::queue(['emails.default', 'emails.plain.default'], ['mail' => $user], function($m) use($user) {
    		$m->to(env('EMAIL_ADMIN'))->replyTo($user['email'], $user['name'])->subject($user['type']);
    	});

    	\Flash::info('Köszönjük, hogy felvetted velünk a kapcsolatot, hamarosan választ adunk kérdésedre.');

    	return redirect()->route('contact');
    }

    public function downloads()
    {
    	return View('downloads');
    }

    public function donation()
    {
        $ranks = \App\Ranks::all();

        return View('donation')->with('ranks', $ranks);
    }
	
	public function map()
	{
		return View('map');
	}

    public function paypal()
    {
        return View('payment.paypal');
    }

	public function sites($slug)
    {
        $page = \App\Page::where('slug', $slug)->first();

        return View('site')->with('page', $page);
    }
	
    public function sms()
    {
        return View('payment.sms');
    }
}
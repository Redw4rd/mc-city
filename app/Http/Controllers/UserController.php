<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\TicketCreateRequest;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function profile()
    {
    	return View('profile.index');
    }

    public function postProfile(Request $request)
    {
        $user = \Auth::user();

        $user->update([
            'name' => $request->input('name'),
            'displayed_name' => $request->input('displayed_name'),
            'avatar_image' => $request->input('avatar_image'),
            'subscribe_newsletter' => $request->input('subscribe_newsletter'),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        activity('Profil módosítás')->log('Felhasználói fiók adatainak módosítása');

        \Flash::info('Az adataidat elmentettük!');

        return redirect(route('profile'));
    }

    public function activityLog()
    {
        $activity_log = Activity::where('causer_id', \Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        return View('profile.activity')->with('activity_log', $activity_log);
    }

    public function resetPassword()
    {
        return View('profile.password_reset');
    }

    public function postResetPassword(PasswordResetRequest $request)
    {
        $user = \App\User::find(\Auth::user()->id);

        $user->update([
            'password' => bcrypt($request->input('password'))
        ]);

        \Flash::info('A jelszavad megváltozott!');
        activity('Profil módosítás')->log('Jelszó módosítás azonosított felhasználói fiókból');

        return redirect()->route('modify-password');
    }

    public function tickets(Request $request, $ticket_id=null)
    {
    	if ($ticket_id) {

            $ticket = \App\Tickets::find($ticket_id);

            if (!$ticket)
                abort(404);

            if ($ticket->user_id != \Auth::user()->id) {

                \Flash::error('Csak a saját hibajegyeidet láthatod!');

                return redirect()->route('tickets');
            }

    		return View('profile.ticket')->with('ticket', $ticket);
    	}

        $tickets = \App\Tickets::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->paginate(20);

    	return View('profile.tickets')->with([
            'tickets' => $tickets,
            'settings' => [
                'types' => explode('|', str_replace('-', ' ', env('TICKETS_TYPES')))
            ]
        ]);
    }

    public function postTicket(TicketCreateRequest $request)
    {
        $ticket = new \App\Tickets;

        $ticket->insert([
            'type' => $request->input('category'),
            'message' => $request->input('message'),
            'user_id' => \Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \Flash::info('Hibajegyed rögzítettük! Hamarosan megválaszoljuk felmerülő problémádat.');
        activity('Hibajegyek')->log('Hibajegy küldés');

        return redirect()->route('tickets');
    }

    public function sendTicketMessage(TicketCreateRequest $request)
    {
    	$ticket = \App\Tickets::find($request->input('ticket_id'));

        if ($ticket->user_id != \Auth::user()->id)
            return redirect()->route('tickets');

        if ($ticket->is_locked == true) {
            \Flash::warning('Ez a hibajegy zárolva lett, így nem tudsz további üzeneteket küldeni.');

            return redirect()->route('tickets', $request->input('ticket_id'));
        }

        $message = new \App\TicketsMessages;

        $message->insert([
            'ticket_id' => $request->input('ticket_id'),
            'message' => $request->input('message'),
            'user_id' => \Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $ticket->update([
            'answered' => false,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        \Flash::info('Válaszodat rögzítettük, kollegánk hamarosan válaszolni fog üzenetedre.');
        activity('Hibajegyek')->log('Válaszoltál az egyik hibajegyedre');

        return redirect()->route('tickets', $request->input('ticket_id'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TicketCreateRequest;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\UserRequest;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
    	return View('dashboard.index');
    }

    public function settings_site()
    {
    	return View('dashboard.settings.page');
    }

    public function postSettings_site(Request $request)
    {

        foreach($request->only(['title', 'keywords', 'description', 'social_facebook_link', 'social_youtube_link']) as $row => $value) {

            $option = \App\PageSettings::where('key', $row);

            $option->update([
                'value' => $request->input($row)
            ]);

        }

        \Flash::info('Az oldal adatait elmentettük!');

        return redirect(route('settings.site'));
    }

    public function settings_sales()
    {
        return View('dashboard.settings.sales');
    }

    public function postSettings_sales(Request $request)
    {

        foreach($request->only(['paypal_discount', 'paypal_min_amount']) as $row => $value) {

            $option = \App\PageSettings::where('key', $row);

            $option->update([
                'value' => (int) $request->input($row)
            ]);

        }

        \Flash::info('A beállításokat frissítettük!');

        return redirect(route('settings.sales'));
    }

    public function sites(Request $request, $pagename)
    {
        $page = \App\Page::where('slug', $pagename)->first();

        if (!$page) {

            $allowed = ['aszf', 'aff', 'szabalyzat', 'tortenet'];

            if (in_array($pagename, $allowed)) {
                $page = new \App\Page;

                $temp_page = [
                    'name' => $pagename,
                    'slug' => $pagename,
                    'body' => $pagename . ' placeholder content',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ];

                $page->insert($temp_page);

                $page = $temp_page;
            }
        }

    	return View('dashboard.sites')->with('page', $page);
    }

    public function postSites(Request $request)
    {
        $page = \App\Page::where('slug', $request->input('slug'));

        $page->update([
            'name' => $request->input('name'),
            'body' => $request->input('body'),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        \Flash::success('Az oldal el lett mentve!');

        return redirect()->route('sites', $request->input('slug'));
    }

    public function tickets(Request $request, $ticket_id=null)
    {
        if (!is_null($ticket_id)) {
            return View('dashboard.ticket')->with([
                'ticket' => \App\Tickets::find($ticket_id)
            ]);
        }

        return View('dashboard.tickets')->with([
            'tickets' => \App\Tickets::orderBy('id', 'desc')->get()
        ]);
    }

    public function sendTicketMessage(TicketCreateRequest $request)
    {
        $ticket = \App\Tickets::find($request->input('ticket_id'));

        $message = new \App\TicketsMessages;

        $message->insert([
            'ticket_id' => $request->input('ticket_id'),
            'message' => $request->input('message'),
            'user_id' => \Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $ticket->update([
            'answered' => true,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        \Flash::info('Üzeneted mentettük.');

        return redirect()->route('dashboard.tickets', $request->input('ticket_id'));
    }

    public function lockTicket(Request $request)
    {
        $ticket = \App\Tickets::find($request->input('ticket_id'));

        $ticket->update([
            'answered' => true,
            'is_locked' => true,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        \Flash::info('A hibajegyet sieresen lezártad!');

        return redirect()->route('dashboard.tickets', $request->input('ticket_id'));
    }

    public function news(Request $request, $news_id=null)
    {
        if (!is_null($news_id) && $news_id != 'new') {

            $post = \App\News::find($news_id);

            if (!$post->count()) {
                \Flash::info('Nincs ilyen hír az adatbázisban!');

                return redirect(route('dashboard.news'));
            }

            return View('dashboard.news-edit')->with('post', $post);
        } else if ($news_id == 'new') {
            return View('dashboard.news-edit')->with('post', 'null');
        }

        return View('dashboard.news')->with('news', \App\News::orderBy('id', 'desc')->get());
    }

    public function postNews(NewsRequest $request, $news_id=null)
    {

        if ($request->input('DELETE') == 'yes') {
            $post = \App\News::find($request->input('news_id'));

            $post->delete();

            \Flash::info('A hír törlésre került!');
            return redirect(route('dashboard.news'));
        }

        $post = new \App\News;

        $post->insert([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'body' => $request->input('body'),
            'writer_id' => \Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \Flash::success('A hír a címlapra került!');

        return redirect(route('dashboard.news'));
    }

    public function putNews(NewsRequest $request, $news_id=null)
    {
        $post = \App\News::find($news_id);

        $post->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'body' => $request->input('body'),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \Flash::success('A hír sikeresen módosítva!');

        return redirect(route('dashboard.news'));
    }

    public function users(Request $request, $username=null)
    {

        if ($username != null) {

            $user = \App\User::where('username', $username)->first();

            if ($user == null) {
                \Flash::info('A felhasználó nem található!');

                return redirect(route('users'));
            }

            return View('dashboard.user')->with([
                'user' => $user,
                'ranks' => \App\Ranks::all()
            ]);
        }

        return View('dashboard.users')->with([
            'users' => \App\User::orderBy('id', 'desc')->get()
        ]);
    }

    public function deleteUser(Request $request)
    {
        if ($request->input('DELETE') == 'yes') {
            $user = \App\User::find($request->input('user_id'));

            if (\Auth::user()->id === $user->id) {
                \Flash::warning('Magadat nem tudod törölni!');
                return redirect(route('users'));
            }

            $user->delete();

            \Flash::info('A felhasználó törlésre került!');
            return redirect(route('users'));
        }
    }

    public function activateUser(Request $request)
    {
        if ($request->input('ACTIVATE') == 'yes') {
            $user = \App\User::find($request->input('user_id'));

            $user->update([
                'verify_token' => NULL
            ]);

            \Flash::info('A felhasználót aktiváltuk!');
            return redirect()->back();
        }
    }

    public function updateUser(UserRequest $request)
    {
        $user = \App\User::find($request->input('user_id'));

        //dd($request->all());

        $user->update([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'rank_id' => $request->input('rank'),
            'is_admin' => $request->input('is_admin'),
            'wallet' => (int) $request->input('wallet'),
        ]);

        \Flash::info('A felhasználó adatait módosítottuk!');
        return redirect(route('users', $request->input('username')));
    }

    public function ranks(Request $request, $id=null)
    {
        if (!is_null($id) && $id != 'new') {

            $post = \App\Ranks::find($id);

            if (!$post->count()) {
                \Flash::info('Nincs ilyen rang az adatbázisban!');

                return redirect(route('ranks'));
            }

            return View('dashboard.ranks-edit')->with('post', $post);
        } else if ($id == 'new') {
            return View('dashboard.ranks-edit')->with('post', 'null');
        }

        return View('dashboard.ranks')->with(['ranks' => \App\Ranks::all()]);
    }

    public function postRanks(Request $request)
    {
        if ($request->input('DELETE') == 'yes') {
            $rank = \App\Ranks::find($request->input('rank_id'));

            $rank->delete();

            \Flash::info('A rang törlésre került!');
            return redirect(route('ranks'));
        }

        $rank = new \App\Ranks;

        $rank->insert([
            'name' => $request->input('name'),
            'group' => $request->input('group'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'price' => (int)$request->input('price'),
        ]);

        \Flash::success('A rang el lett mentve!');

        return redirect(route('ranks'));
    }

    public function putRanks(Request $request, $id=null)
    {
        $post = \App\Ranks::find($id);

        $post->update([
            'name' => $request->input('name'),
            'group' => $request->input('group'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'price' => (int)$request->input('price'),
        ]);

        \Flash::success('A rang sikeresen módosítva!');

        return redirect(route('ranks'));
    }

    public function newsletter(Request $request, $id=null)
    {
        if ($id === 'new') {
            return View('dashboard.newsletter-edit');
        }

        return View('dashboard.newsletters')->with([
            'newsletters' => \App\Newsletter::all()
        ]);
    }

    public function postNewsletter(Request $request, $id=null)
    {
        if ($request->input('content') == '') {
            \Flash::info('A hírlevél tartalmát elfelejtetted! ;)');
            return redirect()->back();
        }

        $newsletter = new \App\Newsletter;

        $newsletter->insert([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        /**
         * Queue létrehozás nem ártana!
         */

        return redirect(route('dashboard.newsletter'));
    }

    public function deleteNewsletter(Request $request)
    {
        /**
         * Queue törlés nem ártana!
         */
        if ($request->input('DELETE') == 'yes') {
            $post = \App\Newsletter::find($request->input('id'));

            $post->delete();

            \Flash::info('A hírlevél törlésre került!');
            return redirect(route('dashboard.newsletter'));
        }
    }

    public function Log()
    {
        $activity = Activity::all();
        return View('dashboard.log')->with('activity', $activity);
    }
}

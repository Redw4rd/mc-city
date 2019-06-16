<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNewsletterEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elküld egy rakat hírlevelet.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $newsletter = \App\Newsletter::where('finished', false)->first();

        $users = \App\User::where('id', '>', $newsletter->status)->where('subscribe_newsletter', true)->limit(500)->get();

        foreach($users as $user) {
            \Mail::queue('emails.default', ['mail' => ['content' => $newsletter->content]], function($m) use($user) {
                $m->to($user->email, $user->username)->subject('Pixelhero Hírlevél');
            });
        }

        $userArray = $users->toArray();
        $last = end($userArray);

        $newsletter->update([
            'status' => $last['id'],
            'finished' => (\App\User::orderBy('id', 'desc')->first()->id === $last['id']) ? true : false,
        ]);
    }
}

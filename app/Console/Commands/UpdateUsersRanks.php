<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateUsersRanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ranks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eltávolítja az összes lejárt rangot a felhasználóktól';

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
        $users = \App\User::where('rank_id', '>', 0)->get();

        foreach($users as $user) {
            if (strtotime($user->rank_expire) < strtotime(\Carbon\Carbon::now())) {
                $user->update([
                    'rank_id' => 0,
                ]);
            }
        }

    }
}

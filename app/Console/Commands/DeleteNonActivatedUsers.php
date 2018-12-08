<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;

use LANMS\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Carbon\Carbon;

class DeleteNonActivatedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:dnau';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will delete users that has not been activated yet.';

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
        $users = User::where('last_login', null)->get();
        foreach ($users as $user) {
            $activationcompleted = Activation::completed($user);
            if ($activationcompleted === false && $user->created_at < Carbon::now()->subDays(60)) {
                $user->delete();
                $this->line('Deleted: '.$user->username);
            }
        }
        $this->info('Done.');
    }
}

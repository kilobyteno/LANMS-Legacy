<?php

namespace LANMS\Console\Commands;

use LANMS\User;
use Illuminate\Console\Command;

class FixLastActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:fla';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will fix last_activity timestamps for MySQL 8.';

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
        $users = User::withTrashed()->where('last_activity', '0000-00-00')->get();
        $this->line('Count: '.$users->count());
        foreach ($users as $user) {
            $this->line('Fixing user with ID: '.$user->id);
            $user->last_activity = null;
            $user->save();
        }
        $this->info('Done.');
    }
}

<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;
use anlutro\LaravelSettings\Facade as Setting;
use Carbon\Carbon;

class CheckSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:checkschedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds datetime now of this command being ran.';

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
        Setting::set("APP_SCHEDULE_LAST_RUN", Carbon::now());
        Setting::save();
        $this->info('Updated time.');
    }
}

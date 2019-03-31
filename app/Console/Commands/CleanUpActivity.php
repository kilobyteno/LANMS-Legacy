<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;

use Spatie\Activitylog\Models\Activity;

class CleanUpActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:cleanupactivity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes blank database entries for the activity log.';

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
        $activities = Activity::all()->where('properties', '{"attributes":[],"old":[]}')->where('causer_id', '')->where('causer_type', '');
        $this->info('Entries to delete: '.$activities->count());
        foreach ($activities as $activity) {
            $this->info('Deleting activity entry #'.$activity->id);
            $activity->delete();
        }
        $this->info('Done.');
    }
}

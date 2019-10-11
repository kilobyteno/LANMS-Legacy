<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use anlutro\LaravelSettings\Facade as Setting;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Essential stuff needed for a LANMS update.';

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
        $rev = exec('git rev-parse --short HEAD');
        $branch = exec('git describe --tags --abbrev=0');
        $lanms_ver = $branch.' ('.$rev.')';

        Artisan::call('migrate --force');
        Artisan::call('lanms:refreshpermissions');
        Artisan::call('lanms:refreshinfo');
        Artisan::call('lanms:checklicense');
        if (Setting::has('APP_VERSION_TYPE')) {
            Setting::forget('APP_VERSION_TYPE');
        }
        if (Setting::get('APP_VERSION') != $lanms_ver) {
            $this->info('Current version: '.Setting::get('APP_VERSION'));
            Setting::set('APP_VERSION', $lanms_ver);
            $this->info('Updated version to: '.Setting::get('APP_VERSION'));
            Setting::save();
        }
    }
}

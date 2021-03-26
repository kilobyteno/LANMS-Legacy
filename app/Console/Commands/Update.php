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
        $ver = $branch.' ('.$rev.')';

        $this->info('Migrating...');
        Artisan::call('migrate --force');

        $this->info('SettingsTableSeeder...');
        Artisan::call('db:seed --class=SettingsTableSeeder');

        $this->info('Fixing last_activity issues...');
        Artisan::call('lanms:fla');

        $this->info('Refreshing permissions...');
        Artisan::call('lanms:refreshpermissions');

        $this->info('Refreshing info descriptions...');
        Artisan::call('lanms:refreshinfo');

        $this->info('Refreshing setting descriptions...');
        Artisan::call('lanms:refreshsettings');

        $this->info('Deleting old addresses...');
        Artisan::call('lanms:doae');

        $this->info('Checking if birthdates is valid...');
        Artisan::call('lanms:checkbirthdate');
        
        $this->info('Checking license...');
        Artisan::call('lanms:checklicense');

        $this->info('Creating the symbolic link...');
        Artisan::call('storage:link');

        $this->info('Updating version...');
        if (Setting::get('APP_VERSION') != $ver) {
            $this->info('Current version: '.Setting::get('APP_VERSION'));
            Setting::set('APP_VERSION', $ver);
            $this->info('Updated version to: '.Setting::get('APP_VERSION'));
            Setting::save();
        }

        $this->info('Done.');
    }
}

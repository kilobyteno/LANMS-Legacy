<?php

namespace LANMS\Console\Commands;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use LANMS\Rules\OlderThan;
use LANMS\Rules\YoungerThan;
use LANMS\User;

class CheckBirthdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:checkbirthdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will check if a user has a valid birthdate or not.';

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
        $users = User::whereNotNull('birthdate')->get();
        $bar = $this->output->createProgressBar(count($users));
        $bar->start();
        foreach ($users as $user) {
            $validator = Validator::make($user->toArray(), [
                'birthdate' => ['required', 'date_format:Y-m-d', new OlderThan, new YoungerThan],
            ]);
            if ($validator->fails()) {
                Sentinel::update($user, ['birthdate' => null]);
                //$this->line("User failed validation: ".$user->username);
            }
            $bar->advance();
        }
        $bar->finish();
    }
}

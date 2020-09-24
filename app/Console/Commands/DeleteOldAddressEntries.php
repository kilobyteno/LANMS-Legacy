<?php

namespace LANMS\Console\Commands;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use LANMS\Address;
use LANMS\User;

class DeleteOldAddressEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:doae';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will force delete old address entries. Ref: LANMS-416';

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
        // LANMS-415 -- START
        $users = User::withTrashed()->get();
        $bar = $this->output->createProgressBar(count($users));
        $bar->start();
        foreach ($users as $user) {
            $addresses = $user->addresses;
            $main_address = Address::where('user_id', $user->id)->where('main_address', 1)->first();
            if ($main_address) {
                $info = [
                    'address_street' => $main_address->address1.' '.$main_address->address2,
                    'address_postalcode' => $main_address->postalcode,
                    'address_city' => $main_address->city,
                    'address_county' => $main_address->county,
                    'address_country' => $main_address->country,
                ];
                Sentinel::update($user, $info);
                //$this->line('Updating address for user id: '.$user->id);
            }
            DB::update('update users set permissions = null where id = ?', [$user->id]); // Reset all permissions to null.
            if ($addresses) {
                foreach ($addresses as $address) {
                    //$this->line('Deleting address id: '.$address->id);
                    $address->delete();
                }
            }
            $bar->advance();
        }
        $bar->finish();
        // LANMS-415 -- END
        $addresses = Address::withTrashed()->get();
        foreach ($addresses as $address) {
            //$this->line('forceDelete: '.$address->id);
            $address->forceDelete();
        }
        //$this->info('Done.');
    }
}

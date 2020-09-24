<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;
use LANMS\Address;

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
        $addresses = Address::withTrashed()->get();
        foreach ($addresses as $address) {
            $this->line('forceDelete: '.$address->id);
            $address->forceDelete();
        }
        $this->info('Done.');
    }
}

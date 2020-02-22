<?php

namespace LANMS\Console\Commands;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use LANMS\Notifications\InvoiceUnpaid;
use LANMS\User;

class UpdateNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:updatenotifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for things needing a notification for a user and creates a notification.';

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
        foreach (User::active() as $user) {
            if ($user->stripe_customer) {
                $invoices = Stripe::invoices()->all(array('customer' => $user->stripe_customer, 'limit' => 100));
                $invoices = $invoices['data'];
                foreach ($invoices as $invoice) {
                    if ($invoice['paid'] == false && $invoice['status'] != 'draft' && $invoice['status'] != 'void') {
                        $data = [
                            'amount_due' => $invoice['amount_due'],
                            'due_date' => $invoice['due_date'],
                            'currency' => $invoice['currency'],
                            'id' => $invoice['id'],
                            'route' => 'account-billing-invoice-view',
                        ];
                        $db_data = collect($data)->toJson();
                        // Check if there is a notification already
                        $notifications = DB::table('notifications')->where('notifiable_type', 'LANMS\User')->where('notifiable_id', $user->id)->where('read_at', null)->where('data', string($db_data))->count();
                        $this->info('Notification count for '.$user->username.': '.$notifications);
                        if ($notifications === 0) {
                            $this->info('Sending notification to '.$user->username.' for invoice '.$invoice['id']);
                            Notification::send($user, new InvoiceUnpaid($invoice));
                        } else {
                            $this->info('No notification was sent for invoice '.$invoice['id']);
                        }
                    }
                }
            }
        }
    }
}

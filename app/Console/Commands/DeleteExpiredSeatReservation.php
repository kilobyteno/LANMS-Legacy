<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;

class DeleteExpiredSeatReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:desr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will delete expired seat reservation.';

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
        $reservations = \SeatReservation::where('status_id', '=', 2)->get();
		foreach($reservations as $reservation) {
			if(\SeatReservation::getExpireTime($reservation->id) == 'expired') {
				\SeatReservation::find($reservation->id)->delete();
				\Mail::send('emails.seat.removed', array('seatname' => $reservation->seat->name, 'firstname' => $reservation->reservedby->firstname), function($message) use ($reservation) {
					$message->to($reservation->reservedby->email, $reservation->reservedby->firstname)->subject('Reservation Removed!');
				});
				$this->info('"Reservation removal" email sent to '.$reservation->reservedby->username.' for seat '.$reservation->seat->name.' in reservation '.$reservation->id.'.');
			}
			if(\SeatReservation::getExpireTime($reservation->id) == '24 hours' && $reservation->reminder_email_sent <> 1) {
				\Mail::send('emails.seat.removedsoon', array('seatname' => $reservation->seat->name, 'firstname' => $reservation->reservedby->firstname), function($message) use ($reservation) {
					$message->to($reservation->reservedby->email, $reservation->reservedby->firstname)->subject('Reservation Soon Removed');
				});
				$res = \SeatReservation::find($reservation->id);
				$res->reminder_email_sent = 1;
				$res->save();
				$this->info('Reminder sent to '.$reservation->reservedby->username.' for seat '.$reservation->seat->name.' in reservation '.$reservation->id.'.');
			}
		}
        $this->info('Done.');
    }
}

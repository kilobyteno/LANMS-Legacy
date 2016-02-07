<?php namespace LANMS\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Please note the different namespace 
		// and please add a \ in front of your classes in the global namespace
		\Event::listen('cron.collectJobs', function() {

			\Cron::add('DeleteExpiredReservations', '*/1 * * * *', function() {

				$reservations = \SeatReservation::where('status_id', '=', 2)->get();
				foreach($reservations as $reservation) {
					if(\SeatReservation::getExpireTime($reservation->id) == 'expired') {
						\SeatReservation::find($reservation->id)->delete();
						\Mail::send('emails.seat.removed', array('seatname' => $seatname, 'firstname' => $reservation->reservedby->firstname), function($message) use ($reservation) {
							$message->to($reservation->reservedby->email, $reservation->reservedby->firstname)->subject('Reservation Removed!');
						});
					}
					if(\SeatReservation::getExpireTime($reservation->id) == '24 hours' && $reservation->reminder_email_sent <> 1) {
						\Mail::send('emails.seat.removedsoon', array('seatname' => $seatname, 'firstname' => $reservation->reservedby->firstname), function($message) use ($reservation) {
							$message->to($reservation->reservedby->email, $reservation->reservedby->firstname)->subject('Reservation Soon Removed');
						});
						$res = \SeatReservation::find($reservation->id);
						$res->reminder_email_sent = 1;
						$res->save();
					}
				}



				return 'OK';

			});

			/* 
				Add this in CPanel:
				* * * * * /usr/bin/php /var/www/laravel/artisan cron:run
			*/
			
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'LANMS\Services\Registrar'
		);
	}

}

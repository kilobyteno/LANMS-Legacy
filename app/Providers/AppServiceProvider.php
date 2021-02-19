<?php namespace LANMS\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use LANMS\Observers\ActivityObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		// https://laravel-news.com/laravel-5-4-key-too-long-error
		Schema::defaultStringLength(191);
		
		if(Schema::hasTable('settings')) {
			if (setting('WEB_PROTOCOL') == 'https') {
				URL::forceScheme('https');
			}
		}

		Activity::observe(ActivityObserver::class);

		Paginator::useBootstrap();

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

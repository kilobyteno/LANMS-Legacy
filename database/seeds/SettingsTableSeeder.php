<?php

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facade as Setting;
  
class SettingsTableSeeder extends Seeder {
  
	public function run() {

		Setting::set('APP_NAME', 'LANMS');
		Setting::set('APP_VERSION', '2.0.0');
		Setting::set('APP_VERSION_TYPE', '&beta;eta');
		Setting::set('APP_URL', 'http://jira.infihex.com/projects/LANMS/issues');
		Setting::set('SHOW_RESETDB', true);

		Setting::set('MAIL_MAIN_EMAIL', 'hello@lanms.dev');
		Setting::set('MAIL_NOREPLY_EMAIL', 'noreply@lanms.dev');
		Setting::set('MAIL_SUPPORT_EMAIL', 'support@infihex.com');
		Setting::set('MAIL_SUPPORT_EMAIL_NAME', 'Infihex Support');
		Setting::set('MAIL_DEBUG_EMAIL', 'daniel@infihex.com');
		Setting::set('MAIL_DEBUG_EMAIL_NAME', 'Daniel Billing / Infihex');

		Setting::set('WEB_PROTOCOL', 'http');
		Setting::set('WEB_DOMAIN', 'lanms.dev');
		Setting::set('WEB_PORT', 80);
		Setting::set('WEB_NAME', 'LANMS');
		Setting::set('WEB_LOGO', '/images/lanms.png');
		Setting::set('WEB_LOGO_ALT', '/images/lanms_dark.png');
		Setting::set('WEB_COPYRIGHT', '2015-2016, Infihex');

		Setting::set('SEATING_OPEN', true);
		Setting::set('SEATING_SHOW_MAP', true);
		Setting::set('SEATING_SEAT_EXPIRE_HOURS', 48);
		Setting::set('SEATING_SEAT_PRICE', 200);
		Setting::set('SEATING_SEAT_PRICE_ALT', 250);

		Setting::set('GOOGLE_MAPS_API_KEY', 'AIzaSyCJDbjolbvN7mYY3SiV6A7SLPCBlHlE-Ow');

		Setting::set('REFERRAL_ACTIVE', True);

		Setting::set('STRIPE_TEST_SECRET_KEY', 'sk_test_pOqqSRPoUVK52CFMkg7uLxMm');
		Setting::set('STRIPE_TEST_PUBLIC_KEY', 'pk_test_2JLudoJmBqRpvCOwtlaR8QdH');

		Setting::set('STRIPE_LIVE_SECRET_KEY', 'sk_live_r6atfFMnEDQs2QkEMv4x2LNh');
		Setting::set('STRIPE_LIVE_PUBLIC_KEY', 'pk_live_fCK6at9DkHxflHS9Efcp9D35');

		Setting::save();
	}

}
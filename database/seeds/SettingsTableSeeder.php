<?php

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facade as Setting;
  
class SettingsTableSeeder extends Seeder {
  
	public function run() {

		Setting::set('APP_NAME', 'LANMS');
		Setting::set('APP_VERSION', '2.0.0');
		Setting::set('APP_VERSION_TYPE', '&beta;eta');
		Setting::set('APP_URL', 'http://jira.infihex.com/projects/LANMS/issues');
		Setting::set('APP_SHOW_RESETDB', true);

		Setting::set('APP_MAIN_EMAIL', 'hello@lanms.dev');
		Setting::set('APP_NOREPLY_EMAIL', 'noreply@lanms.dev');
		Setting::set('APP_SUPPORT_EMAIL', 'support@infihex.com');
		Setting::set('APP_SUPPORT_EMAIL_NAME', 'Infihex Support');
		Setting::set('APP_DEBUG_EMAIL', 'daniel@infihex.com');
		Setting::set('APP_DEBUG_EMAIL_NAME', 'Daniel Billing / Infihex');

		Setting::set('WEB_PROTOCOL', 'http');
		Setting::set('WEB_DOMAIN', 'lanms.dev');
		Setting::set('WEB_PORT', 80);
		Setting::set('WEB_NAME', 'LANMS');
		Setting::set('WEB_LOGO', 'images/lanms.png');
		Setting::set('WEB_LOGO_ALT', 'images/lanms_dark.png');
		Setting::set('WEB_COPYRIGHT', '2015-2016, Infihex');

		Setting::save();
	}

}
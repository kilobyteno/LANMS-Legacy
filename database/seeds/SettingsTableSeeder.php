<?php

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facade as Setting;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        if (env('APP_LICENSE_KEY') && env('APP_ENV') && env('APP_LOG_LEVEL') == 'debug') {
            $license = env('APP_LICENSE_KEY');
        } else {
            $license = '';
        }
        Setting::set('APP_NAME', 'LANMS');
        Setting::set('APP_VERSION', '');
        Setting::set('APP_URL', 'http://lanms.xyz/');
        Setting::set('APP_LICENSE_STATUS', '');
        Setting::set('APP_LICENSE_STATUS_DESC', '');
        Setting::set('APP_LICENSE_LOCAL_KEY', '');
        Setting::set('APP_LICENSE_KEY', $license);
        Setting::set('APP_SHOW_RESETDB', true);

        Setting::set('WEB_PROTOCOL', 'http');
        Setting::set('WEB_DOMAIN', 'lanms.io');
        Setting::set('WEB_PORT', 80);
        Setting::set('WEB_NAME', 'LANMS');
        Setting::set('WEB_LOGO_LIGHT', '/images/lanms_light.png');
        Setting::set('WEB_LOGO_DARK', '/images/lanms_dark.png');
        Setting::set('WEB_COPYRIGHT', '2015-2019, Infihex');

        Setting::set('SEATING_OPEN', true);
        Setting::set('SEATING_SHOW_MAP', true);
        Setting::set('SEATING_SEAT_EXPIRE_HOURS', 48);
        Setting::set('SEATING_SEAT_PRICE', 250);
        Setting::set('SEATING_SEAT_PRICE_ALT', 300);
        Setting::set('SEATING_SEAT_PRICE_CURRENCY', 'NOK');
        Setting::set('SEATING_YEAR', 2020);
        
        Setting::set('REFERRAL_ACTIVE', true);
        Setting::set('LOGIN_ENABLED', true);

        Setting::set('GOOGLE_MAPS_API_KEY', '');
        Setting::set('GOOGLE_ANALYTICS_TRACKING_ID', '');
        Setting::set('GOOGLE_CALENDAR_API_KEY', '');
        Setting::set('GOOGLE_CALENDAR_ID', '');
        Setting::set('GOOGLE_CALENDAR_START_DATE', '1970-01-30');

        Setting::set('FACEBOOK_MESSENGER_APP_ID', '');
        Setting::set('FACEBOOK_MESSENGER_PAGE_ID', '');

        Setting::save();
    }
}

<?php

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facade as Setting;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        Setting::set('APP_NAME', 'LANMS');
        Setting::set('APP_VERSION', '2.5.0');
        Setting::set('APP_VERSION_TYPE', 'Dev');
        Setting::set('APP_URL', 'http://lanms.xyz/');
        Setting::set('APP_LICENSE_STATUS', '');
        Setting::set('APP_LICENSE_STATUS_DESC', '');
        Setting::set('APP_LICENSE_LOCAL_KEY', '');
        Setting::set('APP_LICENSE_KEY', '');

        Setting::set('SHOW_RESETDB', true);

        Setting::set('MAIL_MAIN_EMAIL', 'hello@lanms.io');
        Setting::set('MAIL_NOREPLY_EMAIL', 'noreply@lanms.io');

        Setting::set('WEB_PROTOCOL', 'http');
        Setting::set('WEB_DOMAIN', 'lanms.io');
        Setting::set('WEB_PORT', 80);
        Setting::set('WEB_NAME', 'LANMS');
        Setting::set('WEB_LOGO', '/images/lanms.png');
        Setting::set('WEB_LOGO_ALT', '/images/lanms_dark.png');
        Setting::set('WEB_COPYRIGHT', '2015-2018, Infihex');

        Setting::set('SEATING_OPEN', true);
        Setting::set('SEATING_SHOW_MAP', true);
        Setting::set('SEATING_SEAT_EXPIRE_HOURS', 48);
        Setting::set('SEATING_SEAT_PRICE', 250);
        Setting::set('SEATING_SEAT_PRICE_ALT', 300);
        Setting::set('SEATING_SEAT_PRICE_CURRENCY', 'NOK');
        Setting::set('SEATING_YEAR', 2019);
        
        Setting::set('REFERRAL_ACTIVE', true);
        Setting::set('LOGIN_ENABLED', true);

        Setting::set('GOOGLE_MAPS_API_KEY', '');
        Setting::set('GOOGLE_ANALYTICS_TRACKING_ID', '');
        Setting::set('GOOGLE_CALENDAR_API_KEY', '');
        Setting::set('GOOGLE_CALENDAR_ID', '');
        Setting::set('GOOGLE_CALENDAR_START_DATE', '1970-01-30');

        Setting::set('FACEBOOK_APP_ID', '');
        Setting::set('FACEBOOK_PAGE_ID', '');

        Setting::save();
    }
}

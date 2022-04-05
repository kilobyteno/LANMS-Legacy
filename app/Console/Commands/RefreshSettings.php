<?php

namespace LANMS\Console\Commands;

use Illuminate\Console\Command;
use LANMS\AppSetting;
use anlutro\LaravelSettings\Facade as Setting;

class RefreshSettings extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'lanms:refreshsettings';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'This will update all settings with proper description fields.';

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
        // Add new settings
        // LANMS-377
        if (!Setting::has('HEADER_INFO_CONSENT_FORM')) {
            Setting::set('HEADER_INFO_CONSENT_FORM', '1');
            $this->info('Added HEADER_INFO_CONSENT_FORM.');
        }
        // LANMS-328
        if (!Setting::has('SEATING_SELF_CHECKIN_OPEN')) {
            Setting::set('SEATING_SELF_CHECKIN_OPEN', '0');
            $this->info('Added SEATING_SELF_CHECKIN_OPEN.');
        }
        // LANMS-421
        if (!Setting::has('MAIN_ENABLE_GRASROTANDELEN_WIDGET')) {
            Setting::set('MAIN_ENABLE_GRASROTANDELEN_WIDGET', '0');
            $this->info('Added MAIN_ENABLE_GRASROTANDELEN_WIDGET.');
        }
        if (!Setting::has('MAIN_ORGNR')) {
            Setting::set('MAIN_ORGNR', '');
            $this->info('Added MAIN_ORGNR.');
        }
        // LANMS-428
        if (!Setting::has('GOOGLE_CALENDAR_DAYS_TO_SHOW')) {
            Setting::set('GOOGLE_CALENDAR_DAYS_TO_SHOW', '3');
            $this->info('Added GOOGLE_CALENDAR_DAYS_TO_SHOW.');
        }

        // Remove old settings
        if (Setting::has('MAIL_MAIN_EMAIL')) {
            Setting::forget('MAIL_MAIN_EMAIL');
            $this->info('Removed MAIL_MAIN_EMAIL.');
        }
        if (Setting::has('MAIL_NOREPLY_EMAIL')) {
            Setting::forget('MAIL_NOREPLY_EMAIL');
            $this->info('Removed MAIL_NOREPLY_EMAIL.');
        }
        if (Setting::has('APP_VERSION_TYPE')) {
            Setting::forget('APP_VERSION_TYPE');
            $this->info('Removed APP_VERSION_TYPE.');
        }
        if (Setting::has('GOOGLE_MAPS_API_KEY')) {
            Setting::forget('GOOGLE_MAPS_API_KEY');
            $this->info('Removed GOOGLE_MAPS_API_KEY.');
        }
        if (Setting::has('SEATING_SEAT_PRICE')) {
            Setting::forget('SEATING_SEAT_PRICE');
            $this->info('Removed SEATING_SEAT_PRICE.');
        }
        if (Setting::has('SEATING_SEAT_PRICE_ALT')) {
            Setting::forget('SEATING_SEAT_PRICE_ALT');
            $this->info('Removed SEATING_SEAT_PRICE_ALT.');
        }
        // LANMS-434
        if (Setting::has('MAIL_SUPPORT_EMAIL')) {
            Setting::forget('MAIL_SUPPORT_EMAIL');
            $this->info('Removed MAIL_SUPPORT_EMAIL.');
        }
        if (Setting::has('MAIL_SUPPORT_EMAIL_NAME')) {
            Setting::forget('MAIL_SUPPORT_EMAIL_NAME');
            $this->info('Removed MAIL_SUPPORT_EMAIL_NAME.');
        }
        if (Setting::has('MAIL_DEBUG_EMAIL')) {
            Setting::forget('MAIL_DEBUG_EMAIL');
            $this->info('Removed MAIL_DEBUG_EMAIL.');
        }
        if (Setting::has('MAIL_DEBUG_EMAIL_NAME')) {
            Setting::forget('MAIL_DEBUG_EMAIL_NAME');
            $this->info('Removed MAIL_DEBUG_EMAIL_NAME.');
        }

        // Rename old styled settings
        if (Setting::has('SHOW_RESETDB')) {
            Setting::set('APP_SHOW_RESETDB', Setting::get('SHOW_RESETDB'));
            Setting::forget('SHOW_RESETDB');
            $this->info('Renmamed SHOW_RESETDB to APP_SHOW_RESETDB');
        }
        if (Setting::has('WEB_LOGO')) {
            Setting::set('WEB_LOGO_LIGHT', Setting::get('WEB_LOGO'));
            Setting::forget('WEB_LOGO');
            $this->info('Renmamed WEB_LOGO to WEB_LOGO_LIGHT');
        }
        if (Setting::has('WEB_LOGO_ALT')) {
            Setting::set('WEB_LOGO_DARK', Setting::get('WEB_LOGO_ALT'));
            Setting::forget('WEB_LOGO_ALT');
            $this->info('Renmamed WEB_LOGO_ALT to WEB_LOGO_DARK');
        }
        if (Setting::has('FACEBOOK_APP_ID')) {
            Setting::set('FACEBOOK_MESSENGER_APP_ID', Setting::get('FACEBOOK_APP_ID'));
            Setting::forget('FACEBOOK_APP_ID');
            $this->info('Renmamed FACEBOOK_APP_ID to FACEBOOK_MESSENGER_APP_ID');
        }
        if (Setting::has('FACEBOOK_PAGE_ID')) {
            Setting::set('FACEBOOK_MESSENGER_PAGE_ID', Setting::get('FACEBOOK_PAGE_ID'));
            Setting::forget('FACEBOOK_PAGE_ID');
            $this->info('Renmamed FACEBOOK_PAGE_ID to FACEBOOK_MESSENGER_PAGE_ID');
        }

        if (Setting::has('SEATING_SEAT_PRICE_CURRENCY')) {
            Setting::set('MAIN_CURRENCY', Setting::get('SEATING_SEAT_PRICE_CURRENCY'));
            Setting::forget('SEATING_SEAT_PRICE_CURRENCY');
            $this->info('Renmamed SEATING_SEAT_PRICE_CURRENCY to MAIN_CURRENCY');
        }

        if (Setting::has('GOOGLE_ANALYTICS_TRACKING_ID')) {
            Setting::forget('GOOGLE_ANALYTICS_TRACKING_ID');
            $this->info('Removed GOOGLE_ANALYTICS_TRACKING_ID');
        }

        Setting::save();

        // Add description to settings
        $settings = AppSetting::all();
        $descriptions = array(
            'MAIN_ORGNR' => 'Add your orgnr from BRREG here. Used for footer and Grasrotandelen.',
            'MAIN_ENABLE_GRASROTANDELEN_WIDGET' => 'Set this to "0" (without quotes) to disable Grasrotandelen on the homepage. If it is set to "1" (without quotes) Grasrotandelen will be visible on the homepage.',
            'FACEBOOK_MESSENGER_APP_ID' => 'This is used for the messenger integration for users. Create an app on <a target="_blank" href="https://developers.facebook.com/">https://developers.facebook.com/</a> and paste its ID here. Example: 1234567890123456',
            'FACEBOOK_MESSENGER_PAGE_ID' => 'This is used for the messenger integration for users. This is the ID not the URL of the page. You will find it under "about" on the bottom on your page. Example: 1234567890123456',
            'GOOGLE_CALENDAR_API_KEY' => 'Please refer to <a target="_blank" href="https://portal.kilobyte.no/knowledgebase/7/Google-Calendar-Integration.html">this guide</a>.',
            'GOOGLE_CALENDAR_ID' => 'Please refer to <a target="_blank" href="https://portal.kilobyte.no/knowledgebase/7/Google-Calendar-Integration.html">this guide</a>.',
            'GOOGLE_CALENDAR_START_DATE' => 'This will be the date you want the calendar to start. Example: 1970-01-30',
            'GOOGLE_CALENDAR_DAYS_TO_SHOW' => 'Days to show in the calendar. Example: 3',
            'LOGIN_ENABLED' => 'If you only want users with the "admin"-permission to login set this to "0" (without quotes). If it is set to "1" (without quotes) all users will be able to login.',
            'REFERRAL_ACTIVE' => 'You can enable or disable the view of referral on the users dashboard.',
            'SEATING_OPEN' => 'Set this to "0" (without quotes) to disable users from making changes to reservations. If it is set to "1" (without quotes) users will be able to make changes to their reservations.',
            'SEATING_SEAT_EXPIRE_HOURS' => 'Integer only. Set this to the amount of hours you want temporary reserved seats to last.',
            'MAIN_CURRENCY' => 'String only. Your currency in ISO 4217 format.',
            'SEATING_SHOW_MAP' => 'Set this to "0" (without quotes) to disable users from seeing the seatmap. If it is set to "1" (without quotes) users will be see the seatmap.',
            'SEATING_YEAR' => 'Integer only. Set this to the year of the event.',
            'SEATING_SELF_CHECKIN_OPEN' => 'Set this to "0" (without quotes) to disable users from seeing and using the self-checkin. If it is set to "1" (without quotes) it will be enabled.',
            'WEB_COPYRIGHT' => 'String only. Example: 2015-2022 Kilobyte AS',
            'WEB_DOMAIN' => 'String only. This would be the domain your website is hosted on. Example: lanms.kilobyte.no',
            'WEB_LOGO_LIGHT' => 'Path to your light logo, used for dark backgrounds.',
            'WEB_LOGO_DARK' => 'Path to your dark logo, used for light backgrounds.',
            'WEB_NAME' => 'Name of your website. Example: KilobyteLAN',
            'WEB_PORT' => 'Integer only. Do not edit this unless you run your server on a specific port.',
            'WEB_PROTOCOL' => 'String only. Only enter "http" (without quotes) or "https" (without quotes).',
            'HEADER_INFO_CONSENT_FORM' => 'Set this to "0" (without quotes) to remove consent form from header. If it is set to "1" (without quotes) consent form will be visible.',
        );
        foreach ($settings as $setting) {
            if (array_key_exists($setting->key, $descriptions)) {
                if (is_null($setting->description) || $setting->description != $descriptions[$setting->key]) {
                    $setting->description = $descriptions[$setting->key];
                    $setting->save();
                    $this->info('Updated description for '.$setting->key);
                }
            }
        }
    }
}

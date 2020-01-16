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

        Setting::save();

        // Add description to settings
        $settings = AppSetting::all();
        $descriptions = array(
            'FACEBOOK_MESSENGER_APP_ID' => 'This is used for the messenger integration for users. Create an app on <a target="_blank" href="https://developers.facebook.com/">https://developers.facebook.com/</a> and paste its ID here. Example: 1234567890123456',
            'FACEBOOK_MESSENGER_PAGE_ID' => 'This is used for the messenger integration for users. This is the ID not the URL of the page. You will find it under "about" on the bottom on your page. Example: 1234567890123456',
            'GOOGLE_ANALYTICS_TRACKING_ID' => 'This is used for tracking traffic on your website. Example: UA-12345678-0',
            'GOOGLE_CALENDAR_API_KEY' => 'Please refer to <a target="_blank" href="https://my.infihex.com/knowledgebase/7/Google-Calendar-Integration.html">this guide</a>.',
            'GOOGLE_CALENDAR_ID' => 'Please refer to <a target="_blank" href="https://my.infihex.com/knowledgebase/7/Google-Calendar-Integration.html">this guide</a>.',
            'GOOGLE_CALENDAR_START_DATE' => 'This will be the date you want the calendar to start. Example: 1970-01-30',
            'LOGIN_ENABLED' => 'If you only want users with the "admin"-permission to login set this to "0" (without quotes). If it is set to "1" (without quotes) all users will be able to login.',
            'REFERRAL_ACTIVE' => 'You can enable or disable the view of referral on the users dashboard.',
            'SEATING_OPEN' => 'Set this to "0" (without quotes) to disable users from making changes to reservations. If it is set to "1" (without quotes) users will be able to make changes to their reservations.',
            'SEATING_SEAT_EXPIRE_HOURS' => 'Integer only. Set this to the amount of hours you want temporary reserved seats to last.',
            'MAIN_CURRENCY' => 'String only. Your currency in ISO 4217 format.',
            'SEATING_SHOW_MAP' => 'Set this to "0" (without quotes) to disable users from seeing the seatmap. If it is set to "1" (without quotes) users will be see the seatmap.',
            'SEATING_YEAR' => 'Integer only. Set this to the year of the event.',
            'WEB_COPYRIGHT' => 'String only. Example: 2015-2019 Infihex',
            'WEB_DOMAIN' => 'String only. This would be the domain your website is hosted on. Example: lanms.infihex.com',
            'WEB_LOGO_LIGHT' => 'Path to your light logo, used for dark backgrounds.',
            'WEB_LOGO_DARK' => 'Path to your dark logo, used for light backgrounds.',
            'WEB_NAME' => 'Name of your website. Example: InfihexLAN',
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
